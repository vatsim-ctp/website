<?php namespace CTP\Http\Middleware;

use Closure;
use Input;
use Request;
use Response;
use Session;
use CTP\Data\Api\Account as ApiAccountData;
use CTP\Data\Api\Request as ApiRequestData;

class ApiAuthenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Let's create an API request!
        $apiRequest = ApiRequestData::create(["method" => Request::method(), "url" => Request::decodedPath(), "data" => Input::all(), 'ip_raw' => Request::ip()]);
        Session::flash("api_request_id", $apiRequest->api_request_id);

        $apiKey = Request::header("vfmu-api-key", Input::get("vfmu-api-key", null));

        // No API key in header.
        if(!$apiKey) {
            return Response::json(["error" => "NotAuthenticated"], 401);
        }

        // Check that the API key is valid.
        $apiAccount = ApiAccountData::where("api_key", "=", $apiKey)
                                    ->first();

        if(!$apiAccount) {
            return Response::json(["error" => "InvalidApiKey"], 401);
        }

        $apiRequest->api_account_id = $apiAccount->api_account_id;
        $apiRequest->save();

        // Now let's check this is a valid IP!
        $ipsCount = $apiAccount->ips()
                               ->where("ip", "=", ip2long(Request::ip()))
                               ->count();
        if($apiAccount->ip_limited && $ipsCount < 1) {
            return Response::json(["error" => "UnauthorisedClient"], 401);
        } elseif($ipsCount > 0) {
            $apiRequest->api_account_ip_id = $apiAccount->ips()
                                                        ->where("ip", "=", ip2long(Request::ip()))
                                                        ->first()->api_account_ip_id;
            $apiRequest->save();
        }

        // Now let's check that this account has this permission
        $perms = $apiAccount->permissions->filter(function ($p) {
            $perm = explode(":", $p->permission);
            if(Request::method() == array_get($perm, 0, null) && Request::is("api/".array_get($perm, 1, null))) {
                return true;
            }
        });


        if($perms->count() < 1) {
            return Response::json(["error" => "NoPermission"], 401);
        }

        // What about throttling?
        if($apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_limit"} != null) {
            // Period
            if($apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_period"} == "Mo") {
                $throttlePeriodTs = \Carbon\Carbon::now()
                                                  ->subMonth();
            } elseif($apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_period"} == "D") {
                $throttlePeriodTs = \Carbon\Carbon::now()
                                                  ->subDay();
            } elseif($apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_period"} == "H") {
                $throttlePeriodTs = \Carbon\Carbon::now()
                                                  ->subHour();
            } elseif($apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_period"} == "Mi") {
                $throttlePeriodTs = \Carbon\Carbon::now()
                                                  ->subMinute();
            } else {
                $throttlePeriodTs = \Carbon\Carbon::now()
                                                  ->subYear();
            }

            // Are we over?
            if($apiAccount->highest_role->throttle_by == "ip"){
                $requestCount = ApiRequestData::where("ip_raw", "=", Request::ip())
                                           ->where("method", "=", Request::method())
                                           ->where("created_at", ">=", $throttlePeriodTs)
                                           ->count();
            } else {
                $requestCount = $apiAccount->requests()
                                           ->where("method", "=", Request::method())
                                           ->where("created_at", ">=", $throttlePeriodTs)
                                           ->count();
            }
            if($requestCount >= $apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_limit"}) {
                return Response::json(["error" => "ThrottledBy".ucfirst($apiAccount->highest_role->throttle_by)], 429);
            }

            // How many requests left for this type of request?
            $requestsRemaining = $apiAccount->highest_role->{"throttle_" . strtolower(Request::method()) . "_limit"} - $requestCount;
            Session::flash("api_requests_remaining_type", Request::method());
            Session::flash("api_requests_remaining_count", $requestsRemaining);
        }

        return $next($request);
    }

}

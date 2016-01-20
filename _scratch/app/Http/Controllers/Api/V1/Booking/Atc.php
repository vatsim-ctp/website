<?php namespace CTP\Http\Controllers\Api\V1\Booking;

use Input;
use Response;
use CTP\Data\Booking\Atc as AtcBookingData;
use CTP\Data\Vdata\Airport\Facility\Position as PositionData;

class Atc extends \CTP\Http\Controllers\Api\V1\V1ApiController {

    /**
     * @api               {get} /v1/booking/atc Get ATC Bookings.
     * @apiDescription    This endpoint will return a list of all upcoming ATC bookings.
     *                 In order to prevent bookings being displayed too far in advance, there is a limit of 28 days
     *                 ahead.
     *
     * @apiVersion        1.0.0
     * @apiPermission     basic
     * @apiName           getBookingAtc
     * @apiGroup          VData
     *
     * @apiHeader {String} vfmu-api-key The API key you're using for authorisation.
     * @apiHeaderExample {json} Request-Example:
     *                    {
     *                    "vfmu-api-key": "a8kd82j4jasj234j"
     *                    }
     *
     * @apiSuccess {Object[]} bookings The array of bookings.
     * @apiSuccess {String} bookings.booking_atc_id
     * @apiSuccess {String} bookings.start_timestamp
     * @apiSuccess {String} bookings.finish_timestamp
     * @apiSuccess {String} bookings.notes
     * @apiSuccess {Object} bookings.facility_position
     * @apiSuccess {String} bookings.facility_position.name
     * @apiSuccess {String} bookings.facility_position.callsign
     * @apiSuccess {Number} bookings.facility_position.frequency
     * @apiSuccess {Object} bookings.facility_position.facility
     * @apiSuccess {String} bookings.facility_position.facility.name
     * @apiSuccess {String} bookings.facility_position.facility.type
     * @apiSuccess {Object} bookings.user
     * @apiSuccess {Number} bookings.user.user_id
     * @apiSuccess {String} bookings.user.name_first
     * @apiSuccess {String} bookings.user.name_last
     * @apiSuccess {Number} bookings.user.atc_rating
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
     *              "booking_atc_id": "41b0d625-c524-11e4-aae3-040126ff0f01",
     *              "start_timestamp": "2014-11-22 20:45:00",
     *              "finish_timestamp": "2014-11-22 20:45:00",
     *              "facility_position": {
     *                  "name": "Edmonton International Airport Ground",
     *                  "callsign": "CYEG_GND",
     *                  "frequency": 121.7,
     *                  "facility": {
     *                      "name": "Edmonton International Airport Ground",
     *                      "type": "GND"
     *                  }
     *              },
     *              "user": {
     *                  "user_id": "980234",
     *                  "name_first": "Anthony",
     *                  "name_last": "Lawrence",
     *                  "atc_rating": "5"
     *              }
     *          },
     *          {
     *              "booking_atc_id": "41b0f53a-c524-11e4-aae3-040126ff0f01",
     *              "start_timestamp": "2015-01-01 11:15:00",
     *              "finish_timestamp": "2015-01-01 16:15:00",
     *              "facility_position": {
     *                  "name": "Frankfurt am Main International Airport Appro",
     *                  "callsign": "EDDF_APP",
     *                  "frequency": 118.45,
     *                  "facility": {
     *                      "name": "Frankfurt am Main International Airport Appro",
     *                      "type": "APP/DEP"
     *                  }
     *              },
     *              "user": {
     *                  "user_id": "811451",
     *                  "name_first": "Mark",
     *                  "name_last": "Richards",
     *                  "atc_rating": "12"
     *              }
     *          }
     *     ]
     */
    public function index() {
        $bookings = AtcBookingData::with("facilityPosition")
                                  ->with("facilityPosition.facility")
                                  ->with("user")
                                  ->where("finish_timestamp", ">=", \Carbon\Carbon::now())
                                  ->where("start_timestamp", "<=", \Carbon\Carbon::now()
                                                                                 ->addDays(28)
                                                                                 ->toDateTimeString())
                                  ->orderBy("start_timestamp", "ASC")
                                  ->get();

        return Response::api($bookings);
    }

    /**
     * @api               {post} /v1/booking/atc Create ATC booking.
     * @apiDescription    This endpoint will create an ATC booking using the details specified.
     *
     * @apiVersion        1.0.0
     * @apiPermission     enhanced
     * @apiName           postBookingAtc
     * @apiGroup          Bookings
     *
     * @apiHeader {String} vfmu-api-key The API key you're using for authorisation.
     * @apiHeaderExample {json} Request-Example:
     *                    {
     *                    "vfmu-api-key": "a8kd82j4jasj234j"
     *                    }
     *
     * @apiParam {String{10}} position The callsign for the position being booked.
     * @apiParam {Number{6,7}} user_id The CID of the member the booking is being made for.
     * @apiParam {String} start_timestamp The starting timestamp of the booking in Y-m-d H:i:s format
     * @apiParam {String} finish_timestamp The finishing timestamp of the booking in Y-m-d H:i:s format
     * @apiParam {String} [notes] Any additional notes to store about this booking.
     *
     * @apiParamExample {json} Request-Example:
     *                    {
     *                      "position": "EGLL_N_APP",
     *                      "user_id": 980234,
     *                      "start_timestamp": "2015-04-04 18:00:00",
     *                      "finish_timestamp": "2015-04-04 20:00:00"
     *                    }
     *
     * @apiSuccess {String{36}} id The booking ID.  This should be stored for reference.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "id": "59465347-5b25-4d07-a372-a482bff661d1"
     *     }
     *
     * @apiError (404) {String} UnknownPosition The <code>position</code> specified was invalid/not found.
     * @apiError (403) {String} BookingStartHistoric The start time of the booking is in the past.
     * @apiError (403) {String} BookingStartFinishTooClose The start and finish times of the booking are too close (less than
     *                    1 hour).
     * @apiError (403) {String} BookingTooLong The length of the booking exceeds 4 hours.
     * @apiError (403) {String} BookingOverlapOther The given details would overlap with another booking on the same
     *                    position.
     * @apiError (403) {String} BookingOverlapSelf The given details would cause the <code>user_id</code> to have 2 bookings
     *                    overlapping.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       error: "BookingOverlapOther"
     *     }
     */
    public function create() {
        // Let's get all the data.
        // Store both the timestamps and the user.
        $bookingAtc = new AtcBookingData(Input::all());

        // Let's set the position
        $position = PositionData::where("callsign", "LIKE", Input::get("position"))
                                ->first();

        if(!$position) {
            return Response::api(["error" => "UnknownPosition"]);
        }

        $bookingAtc->airport_facility_position_id = $position->airport_facility_position_id;

        // Let's check the start timestamp is in the future.
        if($bookingAtc->start_timestamp->isPast()) {
            return Response::api(["error" => "BookingStartHistoric"], 403);
        }

        // Finish time must be 1 hour more than start time, at least.
        if($bookingAtc->start_timestamp->gt($bookingAtc->finish_timestamp->addHour())) {
            return Response::api(["error" => "BookingStartFinishTooClose"], 403);
        }

        // Finish time cannot be more than 4 hours ahead.
        if($bookingAtc->finish_timestamp->gt($bookingAtc->start_timestamp->addHours(4))) {
            return Response::api(["error" => "BookingTooLong"], 403);
        }

        // Does this booking overlap with any other bookings?
        $checkCompleteMatch = AtcBookingData::where("airport_facility_position_id", "=", $position->airport_facility_position_id)
                                            ->where("start_timestamp", "=", $bookingAtc->start_timestamp)
                                            ->where("finish_timestamp", "=", $bookingAtc->finish_timestamp)
                                            ->count();
        $checkStartWithin = AtcBookingData::where("airport_facility_position_id", "=", $position->airport_facility_position_id)
                                          ->whereBetween("start_timestamp", [$bookingAtc->start_timestamp, $bookingAtc->finish_timestamp->subSecond()])
                                          ->count();
        $checkFinishWithin = AtcBookingData::where("airport_facility_position_id", "=", $position->airport_facility_position_id)
                                           ->whereBetween("finish_timestamp", [$bookingAtc->start_timestamp->addSecond(), $bookingAtc->finish_timestamp])
                                           ->count();

        if($checkCompleteMatch > 0 OR $checkStartWithin > 0 OR $checkFinishWithin > 0) {
            return Response::api(["error" => "BookingOverlapOther"], 403);
        }

        // Check if this user has a booking for the same time on another position.
        $checkUserCompleteMatch = AtcBookingData::where("user_id", "=", $bookingAtc->user_id)
                                                ->where("start_timestamp", "=", $bookingAtc->start_timestamp)
                                                ->where("finish_timestamp", "=", $bookingAtc->finish_timestamp)
                                                ->count();
        $checkUserStartWithin = AtcBookingData::where("user_id", "=", $bookingAtc->user_id)
                                              ->whereBetween("start_timestamp", [$bookingAtc->start_timestamp, $bookingAtc->finish_timestamp->subSecond()])
                                              ->count();
        $checkUserFinishWithin = AtcBookingData::where("user_id", "=", $bookingAtc->user_id)
                                               ->whereBetween("finish_timestamp", [$bookingAtc->start_timestamp->addSecond(), $bookingAtc->finish_timestamp])
                                               ->count();

        if($checkUserCompleteMatch > 0 OR $checkUserFinishWithin > 0 OR $checkUserFinishWithin > 0) {
            return Response::api(["error" => "BookingOverlapSelf"], 403);
        }

        // Let's save!
        $bookingAtc->save();

        return Response::api(["id" => $bookingAtc->booking_atc_id]);
    }

    public function getBooking(AtcBookingData $bookingData){
        return Response::api($bookingData->toArray());
    }

    /**
     * @api               {post} /v1/booking/atc/:booking_atc_id/delete Delete ATC booking.
     * @apiDescription    This endpoint will delete an ATC booking with the given id
     *
     * @apiVersion        1.0.0
     * @apiPermission     enhanced
     * @apiName           postBookingAtcDelete
     * @apiGroup          Bookings
     *
     * @apiHeader {String} vfmu-api-key The API key you're using for authorisation.
     * @apiHeaderExample {json} Request-Example:
     *                    {
     *                    "vfmu-api-key": "a8kd82j4jasj234j"
     *                    }
     *
     * @apiParam {String{36}} booking_atc_id The Booking ID to delete.
     *
     * @apiParamExample {json} Request-Example:
     *                    {
     *                      "booking_atc_id": "59465347-5b25-4d07-a372-a482bff661d1"
     *                    }
     *
     * @apiSuccess {Boolean} result Whether the delete was successful or not.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "result": true
     *     }
     *
     * @apiError (403) {String} HistoricBooking This is a historic booking and cannot be deleted.
     * @apiError (401) {String} NotAuthorisedToDelete You are not permitted to delete this booking.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       error: "NotAuthorisedToDelete"
     *     }
     */
    public function delete(AtcBookingData $atcBooking){
        // Is it already deleted? Or maybe it's just wrong?
        if(!$atcBooking OR $atcBooking->exists === false){
            return Response::api(["error" => "UnknownBooking"], 404);
        }

        // Is the booking in the past?
        if($atcBooking->finish_timestamp->isPast()){
            return Response::api(["error" => "HistoricBooking"], 403);
        }

        // Does this API own the booking, or do we have permission to ignore this?
        if(!$this->apiAccount->hasPermission("ACT:v1_booking_atc_delete_ignore_api_account") && $atcBooking->api_account_id != $this->apiAccount->api_account_id){
            return Response::api(["error" => "NotAuthorisedToDelete"], 401);
        }

        // Let's delete, I guess...
        return Response::api(["result" => $atcBooking->delete()]);
    }
}

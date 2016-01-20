<?php namespace CTP\Http\Controllers\Api\V1;

use \Response;

class Statistics extends V1ApiController {

    /**
     * @api {get} /v1/statistics Get all current statistics
     * @apiDescription This endpoint serves to provide statistical information about booking data VFMU currently holds.
     * @apiVersion 1.0.0
     * @apiPermission basic
     * @apiName getStatistics
     * @apiGroup Statistics
     *
     * @apiHeader {String} vfmu-api-key The API key you're using for authorisation.
     * @apiHeaderExample {json} Request-Example:
     *                    {
     *                    "vfmu-api-key": "a8kd82j4jasj234j"
     *                    }
     *
     * @apiSuccess {String[]} total The total of *all* current statistics.
     *
     * @apiSuccess {String[]} total.bookings
     * @apiSuccess {Number} total.bookings.atc The total number of ATC bookings stored.
     * @apiSuccess {Number} total.bookings.flights The total number of flight bookings stored.
     *
     * @apiSuccess {String[]} total.data
     * @apiSuccess {Number} total.data.airlines Total airlines known about.
     * @apiSuccess {Number} total.data.airports Total airports known about.
     * @apiSuccess {Number} total.data.aircraft Total aircraft known about.
     *
     * @apiSuccess {String[]} total.api
     * @apiSuccess {Number} total.api.requests Total API Requests made.
     * @apiSuccess {Number} total.api.clients Total clients using VFMU.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "total": {
     *              "bookings": {
     *                  "atc": 345,
     *                  "flights": 8979
     *              },
     *              "data": {
     *                  "airlines": 967,
     *                  "airports": 13456,
     *                  "aircraft": 5678
     *              },
     *              "api": {
     *                  "requests": 678956,
     *                  "clients": 15
     *              }
     *          }
     *     }
     */
    public function getStatistics() {
        return Response::api(["total" => ['bookings' => ['atc' => 54, 'flights' => 234]]]);
    }

}

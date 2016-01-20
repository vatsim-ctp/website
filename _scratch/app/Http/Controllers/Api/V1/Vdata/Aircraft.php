<?php namespace CTP\Http\Controllers\Api\V1\Vdata;

use \Response;
use \CTP\Data\Vdata\Aircraft as AircraftData;

class Aircraft extends \CTP\Http\Controllers\Api\V1\V1ApiController {

    /**
     * @api {get} /v1/vdata/aircraft Get aircraft.
     * @apiDescription This endpoint serves to provide details of aircraft currently in the database.
     * @apiVersion 1.0.0
     * @apiPermission basic-level
     * @apiName getAircrafts
     * @apiGroup VData
     *
     * @apiSuccess {Object[]} aircraft The array of aircraft.
     * @apiSuccess {String} aircraft.icao
     * @apiSuccess {String} aircraft.name
     * @apiSuccess {String} aircraft.manufacturer
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
     *              "icao": "B744",
     *              "name": "Boeing 747-400",
     *              "manufacturer": "Boeing"
     *          },
     *          {
     *              "icao": "A321",
     *              "name": "Airbus A321",
     *              "manufacturer": "Airbus Industries"
     *          }
     *     ]
     */
    public function getList() {
        $aircraft = AircraftData::orderBy("icao", "ASC")->get();
        return Response::api($aircraft->toArray());
    }

    /**
     * @api {get} /v1/vdata/aircraft/:icao Get aircraft by ICAO
     * @apiDescription This endpoint serves to provide details of a single aircraft instance.
     * @apiVersion 1.0.0
     * @apiPermission basic-level
     * @apiName getAircraftByIcao
     * @apiGroup VData
     *
     * @apiParam {String{4}} icao The ICAO of the aircraft to get further details about.
     *
     * @apiSuccess {Object} aircraft The aircraft instance.
     * @apiSuccess {String} aircraft.icao
     * @apiSuccess {String} aircraft.name
     * @apiSuccess {String} aircraft.manufacturer
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
 *          {
 *              "icao": "A321",
 *              "name": "Airbus A321",
 *              "manufacturer": "Airbus Industries"
 *          }
     */
    public function getAircraft(AircraftData $aircraft) {
        return Response::api($aircraft->toArray());
    }

}

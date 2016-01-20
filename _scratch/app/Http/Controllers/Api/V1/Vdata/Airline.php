<?php namespace CTP\Http\Controllers\Api\V1\Vdata;

use \Response;
use \CTP\Data\Vdata\Airline as AirlineData;

class Airline extends \CTP\Http\Controllers\Api\V1\V1ApiController {

    /**
     * @api {get} /v1/vdata/airline Get airlines.
     * @apiDescription This endpoint serves to provide details of airlines currently in the database.
     * @apiVersion 1.0.0
     * @apiPermission basic-level
     * @apiName getAirlines
     * @apiGroup VData
     *
     * @apiSuccess {Object[]} airline The array of airlines.
     * @apiSuccess {String} airline.icao
     * @apiSuccess {String} airline.iata
     * @apiSuccess {String} airline.name
     * @apiSuccess {String} airline.callsign
     * @apiSuccess {Boolean} airline.virtual
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
     *              "icao": "BAW",
     *              "iata": "BA",
     *              "name": "British Airways",
     *              "callsign": "SPEEDBIRD",
     *              "virtual": false
     *          },
     *          {
     *              "icao": "EZY",
     *              "iata": "EZ",
     *              "name": "Easyjet",
     *              "callsign": "EASY",
     *              "virtual": false
     *          }
     *     ]
     */
    public function getList() {
        $airlines = AirlineData::orderBy("icao", "ASC")->get();
        return Response::api($airlines->toArray());
    }

    /**
     * @api {get} /v1/vdata/airline/:icao Get airline by ICAO
     * @apiDescription This endpoint serves to provide details of a single airline instance.
     * @apiVersion 1.0.0
     * @apiPermission basic-level
     * @apiName getAirlineByIcao
     * @apiGroup VData
     *
     * @apiParam {String{3}} icao The ICAO code of to airline to retrieve data about.
     *
     * @apiSuccess {Object} airline The airline instance.
     * @apiSuccess {String} airline.icao
     * @apiSuccess {String} airline.iata
     * @apiSuccess {String} airline.name
     * @apiSuccess {String} airline.callsign
     * @apiSuccess {Boolean} airline.virtual
     * @apiSuccess {Object} airline.country
     * @apiSuccess {String} airline.country.code
     * @apiSuccess {String} airline.country.name
     * @apiSuccess {Object} airline.country.continent
     * @apiSuccess {String} airline.country.continent.code
     * @apiSuccess {String} airline.country.continent.name
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *              "icao": "BAW",
     *              "iata": "BA",
     *              "name": "British Airways",
     *              "callsign": "SPEEDBIRD",
     *              "virtual": false,
     *              "country": {
     *                  "code": "GB",
 *                      "name": "United Kingdom",
     *                  "continent" : {
     *                      "code": "EU",
     *                      "name": "Europe"
     *                  }
     *              }
     *          }
     */

    /**
     * @api {get} /v1/vdata/airline/:iata Get airline by IATA
     * @apiDescription This endpoint serves to provide details of a single airline instance.
     * @apiVersion 1.0.0
     * @apiPermission basic-level
     * @apiName getAirlineByIata
     * @apiGroup VData
     *
     * @apiParam {String{2}} iata The IATA code of to airline to retrieve data about.
     *
     * @apiSuccess {Object} airline The airline instance.
     * @apiSuccess {String} airline.icao
     * @apiSuccess {String} airline.iata
     * @apiSuccess {String} airline.name
     * @apiSuccess {String} airline.callsign
     * @apiSuccess {Boolean} airline.virtual
     * @apiSuccess {String} airline.image_url
     * @apiSuccess {Object} airline.country
     * @apiSuccess {String} airline.country.code
     * @apiSuccess {String} airline.country.name
     * @apiSuccess {Object} airline.country.continent
     * @apiSuccess {String} airline.country.continent.code
     * @apiSuccess {String} airline.country.continent.name
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *              "icao": "BAW",
     *              "iata": "BA",
     *              "name": "British Airways",
     *              "callsign": "SPEEDBIRD",
     *              "virtual": false,
     *              "image_url": "http://7ux.co.uk/vfmu/server/public/assets/airline_logos/BAW.png",
     *              "country": {
     *                  "code": "GB",
     *                      "name": "United Kingdom",
     *                  "continent" : {
     *                      "code": "EU",
     *                      "name": "Europe"
     *                  }
     *              }
     *          }
     */
    public function getAirline(AirlineData $airline) {
        $airline->load("country");
        $airline->load("country.continent");
        return Response::api($airline->toArray());
    }
}
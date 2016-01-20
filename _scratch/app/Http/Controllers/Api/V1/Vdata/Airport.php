<?php namespace CTP\Http\Controllers\Api\V1\Vdata;

use Response;
use CTP\Data\Vdata\Airport as AirportData;
use CTP\Data\Vdata\Airport\Facility as FacilityData;
use CTP\Data\Vdata\Airport\Facility\Position as PositionData;

class Airport extends \CTP\Http\Controllers\Api\V1\V1ApiController {

    /**
     * @api               {get} /v1/vdata/airport Get airports.
     * @apiDescription    This endpoint serves to provide details of airports currently in the database.
     * @apiVersion        1.0.0
     * @apiPermission     basic-level
     * @apiName           getAirports
     * @apiGroup          VData
     *
     * @apiSuccess {Object[]} airports The array of airports.
     * @apiSuccess {String} airports.icao
     * @apiSuccess {String} airports.iata
     * @apiSuccess {String} airports.name
     * @apiSuccess {Number} airports.elevation
     * @apiSuccess {Number} airports.latitude
     * @apiSuccess {Number} airports.longitude
     *
     * @apiSuccess {Object} airports.region
     * @apiSuccess {String} airports.region.code
     * @apiSuccess {String} airports.region.name
     * @apiSuccess {Object} airports.region.country
     * @apiSuccess {String} airports.region.country.name
     * @apiSuccess {String} airports.region.country.code
     * @apiSuccess {Object} airports.region.country.continent
     * @apiSuccess {String} airports.region.country.continent.code
     * @apiSuccess {String} airports.region.country.continent.name
     *
     * @apiSuccess {Object[]} airports.facilities
     * @apiSuccess {String} airports.facilities.name
     * @apiSuccess {String} airports.facilities.type
     * @apiSuccess {Object[]} airports.facilities.positions
     * @apiSuccess {String} airports.facilities.positions.name
     * @apiSuccess {String} airports.facilities.positions.callsign
     * @apiSuccess {String} airports.facilities.positions.frequency
     *
     * @apiSuccess {Object[]} airports.runways
     * @apiSuccess {String} airports.runways.identifier
     * @apiSuccess {String} airports.runways.course
     * @apiSuccess {Number} airports.runways.elevation
     * @apiSuccess {Number} airports.runways.longitude
     * @apiSuccess {Number} airports.runways.latitude
     * @apiSuccess {Boolean} airports.runways.ils
     * @apiSuccess {Number} airports.runways.ils_course
     * @apiSuccess {Number} airports.runways.ils_freq
     * @apiSuccess {Number} airports.runways.glidepath
     * @apiSuccess {Object} airports.runways.recipricol
     * @apiSuccess {String} airports.runways.recipricol.identifier
     * @apiSuccess {String} airports.runways.recipricol.course
     * @apiSuccess {Number} airports.runways.recipricol.elevation
     * @apiSuccess {Number} airports.runways.recipricol.longitude
     * @apiSuccess {Number} airports.runways.recipricol.latitude
     * @apiSuccess {Boolean} airports.runways.recipricol.ils
     * @apiSuccess {Number} airports.runways.recipricol.ils_course
     * @apiSuccess {Number} airports.runways.recipricol.ils_freq
     * @apiSuccess {Number} airports.runways.recipricol.glidepath
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      [
     *          {
     *              "icao": "EGLL",
     *              "iata": "LHR",
     *              "name": "London Heathrow",
     *              "elevation": 82,
     *              "longitude": 51.4775,
     *              "latitude": 0.4614,
     *              "region": {
     *                  "code": "EN",
     *                  "name": "England",
     *                  "country": {
     *                      "code": "GB",
     *                      "name": "United Kingdom",
     *                      "continent": {
     *                          "code": "EU",
     *                          "name": "Europe"
     *                          }
     *                  }
     *              },
     *              "facilities": [
     *                  "name": "London Heathrow Director",
     *                  "type": "APP/DEP",
     *                  "positions": [
     *                      {
     *                          "name": "Heathrow Director",
     *                          "callsign": "EGLL_N_APP",
     *                          "frequency": "119.725"
     *                      }
     *                  ]
     *              ],
     *              "runways": [
     *                  {
     *                      "identifer": "09L",
     *                      "course": 90,
     *                      "elevation": 79,
     *                      "longitude": -0.489428,
     *                      "latitude": 51.4775,
     *                      "ils": false,
     *                      "ils_course": 0,
     *                      "ils_freq": 0,
     *                      "glidepath": 3,
     *                      "recipricol": {
     *                          "identifier": "27R",
     *                          "course": 270,
     *                          "elevation": 78,
     *                          "longitude": -0.433264,
     *                          "latitude": 51.4777,
     *                          "ils": false,
     *                          "ils_course": 0,
     *                          "ils_freq": 0,
     *                          "glidepath": 3.0
     *                      }
     *              ]
     *          }
     *      ]
     */
    public function getList() {
        $airport = AirportData::orderBy("icao", "ASC")->paginate(5000);

        return Response::api($airport->toArray());
    }

    /**
     * @api               {get} /v1/vdata/airport/:icao Get airport by ICAO
     * @apiDescription    This endpoint serves to provide details of a single airport instance.
     * @apiVersion        1.0.0
     * @apiPermission     basic-level
     * @apiName           getAirportByIcao
     * @apiGroup          VData
     *
     * @apiParam {String{4}} icao The ICAO of the airport to get further information about.
     *
     * @apiSuccess {Object} airport The airport instance.
     * @apiSuccess {String} airport.icao
     * @apiSuccess {String} airport.iata
     * @apiSuccess {String} airport.name
     * @apiSuccess {Number} airport.elevation
     * @apiSuccess {Number} airport.latitude
     * @apiSuccess {Number} airport.longitude
     *
     * @apiSuccess {Object} airport.region
     * @apiSuccess {String} airport.region.code
     * @apiSuccess {String} airport.region.name
     * @apiSuccess {Object} airport.region.country
     * @apiSuccess {String} airport.region.country.name
     * @apiSuccess {String} airport.region.country.code
     * @apiSuccess {Object} airport.region.country.continent
     * @apiSuccess {String} airport.region.country.continent.code
     * @apiSuccess {String} airport.region.country.continent.name
     *
     * @apiSuccess {Object[]} airport.facilities
     * @apiSuccess {String} airport.facilities.name
     * @apiSuccess {String} airport.facilities.type
     * @apiSuccess {Object[]} airport.facilities.positions
     * @apiSuccess {String} airport.facilities.positions.name
     * @apiSuccess {String} airport.facilities.positions.callsign
     * @apiSuccess {String} airport.facilities.positions.frequency
     *
     * @apiSuccess {Object[]} airport.runways
     * @apiSuccess {String} airport.runways.identifier
     * @apiSuccess {String} airport.runways.course
     * @apiSuccess {Number} airport.runways.elevation
     * @apiSuccess {Number} airport.runways.longitude
     * @apiSuccess {Number} airport.runways.latitude
     * @apiSuccess {Boolean} airport.runways.ils
     * @apiSuccess {Number} airport.runways.ils_course
     * @apiSuccess {Number} airport.runways.ils_freq
     * @apiSuccess {Number} airport.runways.glidepath
     * @apiSuccess {Object} airport.runways.recipricol
     * @apiSuccess {String} airport.runways.recipricol.identifier
     * @apiSuccess {String} airport.runways.recipricol.course
     * @apiSuccess {Number} airport.runways.recipricol.elevation
     * @apiSuccess {Number} airport.runways.recipricol.longitude
     * @apiSuccess {Number} airport.runways.recipricol.latitude
     * @apiSuccess {Boolean} airport.runways.recipricol.ils
     * @apiSuccess {Number} airport.runways.recipricol.ils_course
     * @apiSuccess {Number} airport.runways.recipricol.ils_freq
     * @apiSuccess {Number} airport.runways.recipricol.glidepath
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *              "icao": "EGLL",
     *              "iata": "LHR",
     *              "name": "London Heathrow",
     *              "elevation": 82,
     *              "longitude": 51.4775,
     *              "latitude": 0.4614,
     *              "region": {
     *                  "code": "EN",
     *                  "name": "England",
     *                  "country": {
     *                      "code": "GB",
     *                      "name": "United Kingdom",
     *                      "continent": {
     *                          "code": "EU",
     *                          "name": "Europe"
     *                          }
     *                  }
     *              },
     *              "facilities": [
     *                  "name": "London Heathrow Director",
     *                  "type": "APP/DEP",
     *                  "positions": [
     *                      {
     *                          "name": "Heathrow Director",
     *                          "callsign": "EGLL_N_APP",
     *                          "frequency": "119.725"
     *                      }
     *                  ]
     *              ],
     *              "runways": [
     *                  {
     *                      "identifer": "09L",
     *                      "course": 90,
     *                      "elevation": 79,
     *                      "longitude": -0.489428,
     *                      "latitude": 51.4775,
     *                      "ils": false,
     *                      "ils_course": 0,
     *                      "ils_freq": 0,
     *                      "glidepath": 3,
     *                      "recipricol": {
     *                          "identifier": "27R",
     *                          "course": 270,
     *                          "elevation": 78,
     *                          "longitude": -0.433264,
     *                          "latitude": 51.4777,
     *                          "ils": false,
     *                          "ils_course": 0,
     *                          "ils_freq": 0,
     *                          "glidepath": 3.0
     *                      }
     *              ]
     *          }
     */

    /**
     * @api               {get} /v1/vdata/airport/:iata Get airport by IATA
     * @apiDescription    This endpoint serves to provide details of a single airport instance.
     * @apiVersion        1.0.0
     * @apiPermission     basic-level
     * @apiName           getAirportByIata
     * @apiGroup          VData
     *
     * @apiParam {String{3}} iata The IATA for the airport to retrieve information about.
     *
     * @apiSuccess {Object} airport The airport instance.
     * @apiSuccess {String} airport.icao
     * @apiSuccess {String} airport.iata
     * @apiSuccess {String} airport.name
     * @apiSuccess {Number} airport.elevation
     * @apiSuccess {Number} airport.latitude
     * @apiSuccess {Number} airport.longitude
     *
     * @apiSuccess {Object} airport.region
     * @apiSuccess {String} airport.region.code
     * @apiSuccess {String} airport.region.name
     * @apiSuccess {Object} airport.region.country
     * @apiSuccess {String} airport.region.country.name
     * @apiSuccess {String} airport.region.country.code
     * @apiSuccess {Object} airport.region.country.continent
     * @apiSuccess {String} airport.region.country.continent.code
     * @apiSuccess {String} airport.region.country.continent.name
     *
     * @apiSuccess {Object[]} airport.facilities
     * @apiSuccess {String} airport.facilities.name
     * @apiSuccess {String} airport.facilities.type
     * @apiSuccess {Object[]} airport.facilities.positions
     * @apiSuccess {String} airport.facilities.positions.name
     * @apiSuccess {String} airport.facilities.positions.callsign
     * @apiSuccess {String} airport.facilities.positions.frequency
     *
     * @apiSuccess {Object[]} airport.runways
     * @apiSuccess {String} airport.runways.identifier
     * @apiSuccess {String} airport.runways.course
     * @apiSuccess {Number} airport.runways.elevation
     * @apiSuccess {Number} airport.runways.longitude
     * @apiSuccess {Number} airport.runways.latitude
     * @apiSuccess {Boolean} airport.runways.ils
     * @apiSuccess {Number} airport.runways.ils_course
     * @apiSuccess {Number} airport.runways.ils_freq
     * @apiSuccess {Number} airport.runways.glidepath
     * @apiSuccess {Object} airport.runways.recipricol
     * @apiSuccess {String} airport.runways.recipricol.identifier
     * @apiSuccess {String} airport.runways.recipricol.course
     * @apiSuccess {Number} airport.runways.recipricol.elevation
     * @apiSuccess {Number} airport.runways.recipricol.longitude
     * @apiSuccess {Number} airport.runways.recipricol.latitude
     * @apiSuccess {Boolean} airport.runways.recipricol.ils
     * @apiSuccess {Number} airport.runways.recipricol.ils_course
     * @apiSuccess {Number} airport.runways.recipricol.ils_freq
     * @apiSuccess {Number} airport.runways.recipricol.glidepath
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *              "icao": "EGLL",
     *              "iata": "LHR",
     *              "name": "London Heathrow",
     *              "elevation": 82,
     *              "longitude": 51.4775,
     *              "latitude": 0.4614,
     *              "region": {
     *                  "code": "EN",
     *                  "name": "England",
     *                  "country": {
     *                      "code": "GB",
     *                      "name": "United Kingdom",
     *                      "continent": {
     *                          "code": "EU",
     *                          "name": "Europe"
     *                          }
     *                  }
     *              },
     *              "facilities": [
     *                  "name": "London Heathrow Director",
     *                  "type": "APP/DEP",
     *                  "positions": [
     *                      {
     *                          "name": "Heathrow Director",
     *                          "callsign": "EGLL_N_APP",
     *                          "frequency": "119.725"
     *                      }
     *                  ]
     *              ],
     *              "runways": [
     *                  {
     *                      "identifer": "09L",
     *                      "course": 90,
     *                      "elevation": 79,
     *                      "longitude": -0.489428,
     *                      "latitude": 51.4775,
     *                      "ils": false,
     *                      "ils_course": 0,
     *                      "ils_freq": 0,
     *                      "glidepath": 3,
     *                      "recipricol": {
     *                          "identifier": "27R",
     *                          "course": 270,
     *                          "elevation": 78,
     *                          "longitude": -0.433264,
     *                          "latitude": 51.4777,
     *                          "ils": false,
     *                          "ils_course": 0,
     *                          "ils_freq": 0,
     *                          "glidepath": 3.0
     *                      }
     *              ]
     *          }
     */
    public function getAirport(AirportData $airport) {
        $airport->load("region");
        $airport->load("region.country");
        $airport->load("region.country.continent");
        $airport->load("facilities");
        $airport->load("facilities.positions");
        $airport->load("runways");
        $airport->load("runways.recipricol");

        return Response::api($airport->toArray());
    }

    /**
     * @api               {get} /v1/vdata/airport/:country Get airports by country
     * @apiDescription    This endpoint serves to provide details of all airports in a given country.
     * @apiVersion        1.0.0
     * @apiPermission     basic-level
     * @apiName           getAirportsByCountry
     * @apiGroup          VData
     *
     * @apiParam {String{2}} country The Country Code to filter airports by.
     * @apiParamExample {json} Request-Example:
     *           {
     *           "country": "GB"
     *           }
     *
     * @apiSuccess {Object[]} airports The list of airports in the country.
     * @apiSuccess {String} airports.icao
     * @apiSuccess {String} airports.iata
     * @apiSuccess {String} airports.name
     * @apiSuccess {Number} airports.elevation
     * @apiSuccess {Number} airports.latitude
     * @apiSuccess {Number} airports.longitude
     *
     * @apiSuccess {Object} airports.region
     * @apiSuccess {String} airports.region.code
     * @apiSuccess {String} airports.region.name
     * @apiSuccess {Object} airports.region.country
     * @apiSuccess {String} airports.region.country.name
     * @apiSuccess {String} airports.region.country.code
     * @apiSuccess {Object} airports.region.country.continent
     * @apiSuccess {String} airports.region.country.continent.code
     * @apiSuccess {String} airports.region.country.continent.name
     *
     * @apiSuccess {Object[]} airports.facilities
     * @apiSuccess {String} airports.facilities.name
     * @apiSuccess {String} airports.facilities.type
     * @apiSuccess {Object[]} airports.facilities.positions
     * @apiSuccess {String} airports.facilities.positions.name
     * @apiSuccess {String} airports.facilities.positions.callsign
     * @apiSuccess {String} airports.facilities.positions.frequency
     *
     * @apiSuccess {Object[]} airports.runways
     * @apiSuccess {String} airports.runways.identifier
     * @apiSuccess {String} airports.runways.course
     * @apiSuccess {Number} airports.runways.elevation
     * @apiSuccess {Number} airports.runways.longitude
     * @apiSuccess {Number} airports.runways.latitude
     * @apiSuccess {Boolean} airports.runways.ils
     * @apiSuccess {Number} airports.runways.ils_course
     * @apiSuccess {Number} airports.runways.ils_freq
     * @apiSuccess {Number} airports.runways.glidepath
     * @apiSuccess {Object} airports.runways.recipricol
     * @apiSuccess {String} airports.runways.recipricol.identifier
     * @apiSuccess {String} airports.runways.recipricol.course
     * @apiSuccess {Number} airports.runways.recipricol.elevation
     * @apiSuccess {Number} airports.runways.recipricol.longitude
     * @apiSuccess {Number} airports.runways.recipricol.latitude
     * @apiSuccess {Boolean} airports.runways.recipricol.ils
     * @apiSuccess {Number} airports.runways.recipricol.ils_course
     * @apiSuccess {Number} airports.runways.recipricol.ils_freq
     * @apiSuccess {Number} airports.runways.recipricol.glidepath
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      [
     *          {
     *              "icao": "EGLL",
     *              "iata": "LHR",
     *              "name": "London Heathrow",
     *              "elevation": 82,
     *              "longitude": 51.4775,
     *              "latitude": 0.4614,
     *              "region": {
     *                  "code": "EN",
     *                  "name": "England",
     *                  "country": {
     *                      "code": "GB",
     *                      "name": "United Kingdom",
     *                      "continent": {
     *                          "code": "EU",
     *                          "name": "Europe"
     *                          }
     *                  }
     *              },
     *              "facilities": [
     *                  "name": "London Heathrow Director",
     *                  "type": "APP/DEP",
     *                  "positions": [
     *                      {
     *                          "name": "Heathrow Director",
     *                          "callsign": "EGLL_N_APP",
     *                          "frequency": "119.725"
     *                      }
     *                  ]
     *              ],
     *              "runways": [
     *                  {
     *                      "identifer": "09L",
     *                      "course": 90,
     *                      "elevation": 79,
     *                      "longitude": -0.489428,
     *                      "latitude": 51.4775,
     *                      "ils": false,
     *                      "ils_course": 0,
     *                      "ils_freq": 0,
     *                      "glidepath": 3,
     *                      "recipricol": {
     *                          "identifier": "27R",
     *                          "course": 270,
     *                          "elevation": 78,
     *                          "longitude": -0.433264,
     *                          "latitude": 51.4777,
     *                          "ils": false,
     *                          "ils_course": 0,
     *                          "ils_freq": 0,
     *                          "glidepath": 3.0
     *                      }
     *              ]
     *          }
     *      ]
     */
    public function getAirportByCountry($country) {
        return Response::api(AirportData::where("country_id", "=", $country->country_id)
                                         ->get()
                                         ->toArray());
    }

    /**
     * @api               {get} /v1/vdata/airport/positions Get positions.
     * @apiDescription    This endpoint serves to provide details of all positions in the database.
     * @apiVersion        1.0.0
     * @apiPermission     basic-level
     * @apiName           getAirportPositions
     * @apiGroup          VData
     *
     * @apiSuccess {Object[]} positions The list of positions in the database.
     * @apiSuccess {String} positions.name
     * @apiSuccess {String} positions.callsign
     * @apiSuccess {Number} positions.frequency
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      [
     *          {
     *              "name": "Heathrow Director",
     *              "callsign": "EGLL_N_APP",
     *              "frequency": "119.725"
     *          }
     *      ]
     */
    public function getPositions() {
        $positions = PositionData::with("facility")
                                 ->orderBy("callsign", "ASC")
                                 ->get();

        return Response::api($positions->toArray());
    }
}

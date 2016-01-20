<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Models\Vdata\Airport;
use \Models\Vdata\AirportRunway;

class AirportsRunwaysImport extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'airports:runwaysImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all airport runways from the OurAirports feeds.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $runways = file("http://ourairports.com/data/runways.csv");
        foreach ($runways as $run) {
            $run = str_getcsv($run);
            if (trim($run[0]) == "id") {
                continue;
            } // Skip the header.
            // First, find the airport!
            try {
                $_a = Airport::where("icao", "=", strtoupper($run[2]))->firstOrFail();
            } catch (Exception $ex) {
                continue; // Can't use this, because there's no airport for it!
            }

            /*             * ****** Let's store RUNWAY 1 ******* */
            // Do we need to find or create/update the runway?
            try {
                $_rwy1 = AirportRunway::where("navdata_airport_id", "=", $_a->navdata_airport_id)->where("identifier", "=", $run[8])->firstOrFail();
            } catch (Exception $e) {
                $_rwy1 = new AirportRunway;
            }

            if($_rwy1->exists){ continue; } // IGNORE - NO UPDATING OF CREATED RUNWAYS!

            $_rwy1->navdata_airport_id = $_a->navdata_airport_id;
            $_rwy1->identifier = $run[8];
            $_rwy1->course = $run[12];
            $_rwy1->elevation = $run[11];
            $_rwy1->longitude = $run[10];
            $_rwy1->latitude = $run[9];
            $_rwy1->save();

            /*             * ****** Let's store RUNWAY 2 ******* */
            // Do we need to find or create/update the runway?
            try {
                $_rwy2 = AirportRunway::where("navdata_airport_id", "=", $_a->navdata_airport_id)->where("identifier", "=", $run[14])->firstOrFail();
            } catch (Exception $e) {
                $_rwy2 = new AirportRunway;
            }

            $_rwy2->navdata_airport_id = $_a->navdata_airport_id;
            $_rwy2->identifier = $run[14];
            $_rwy2->course = $run[18];
            $_rwy2->elevation = $run[17];
            $_rwy2->longitude = $run[16];
            $_rwy2->latitude = $run[15];
            $_rwy2->save();

            // Now store the recipricols of both, as we've saved them!
            $_rwy1->recipricol_id = $_rwy2->navdata_airport_runway_id;
            $_rwy1->save();
            $_rwy2->recipricol_id = $_rwy1->navdata_airport_runway_id;
            $_rwy2->save();
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
        );
    }

}

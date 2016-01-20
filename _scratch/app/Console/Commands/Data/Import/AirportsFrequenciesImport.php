<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Models\Vdata\Airport;
use Models\Facility;
use Models\FacilityPosition;

class AirportsFrequenciesImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'airports:frequenciesImport';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all of the airport frequencies from ourairports.com/data/.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
            $frequencies = file("http://ourairports.com/data/airport-frequencies.csv");
            foreach($frequencies as $freq){
                $freq = str_getcsv($freq);
                if(trim($freq[0]) == "id"){ continue; } // Skip the header.

                // We want to ignore silly entries, like unicom.
                if(!in_array($freq[3], array("CLNC DEL", "DEL", "CLNC", "GND", "TWR", "APP", "CNTR", "A/D", "FSS", "ACC", "TMA", "DEP"))){
                    continue;
                }

                // Fix a few of the "types"
                if($freq[3] == "CLNC" OR $freq[3] == "CLNC DEL" OR $freq[3] == "DEL"){
                    $freq[3] = "DEL";
                }
                if($freq[3] == "CNTR" OR $freq[3] == "ACC" OR $freq[3] == "TMA"){
                    $freq[3] = "CTR";
                }
                if($freq[3] == "A/D" OR $freq[3] == "APP" OR $freq[3] == "DEP"){
                    $freq[3] = "APP/DEP";
                }

                // First, find the airport!
                try {
                    $_a = Airport::where("icao", "=", strtoupper($freq[2]))->firstOrFail();
                } catch (Exception $ex) {
                    continue; // Can't use this, because there's no airport for it!
                }

                // Firstly, does the facility exist?
                try {
                    $_fac = Facility::where("navdata_airport_id", "=", $_a->airport_id)->where("type", "=", $freq[3])->firstOrFail();
                } catch(Exception $e){
                    $_fac = new Facility;
                }

                // Figure out the extension for the facility.
                $typeExt = "";
                switch($freq[3]){
                    case "DEL":
                        $typeExt = "Delivery";
                        $suffix = "DEL";
                        break;
                    case "GND":
                        $typeExt = "Ground";
                        $suffix = "GND";
                        break;
                    case "TWR":
                        $typeExt = "Tower";
                        $suffix = "TWR";
                        break;
                    case "APP/DEP":
                        $typeExt = "Approach/Departure";
                        $suffix = "APP";
                        break;
                    case "FSS":
                        $typeExt = "Flight Service Station";
                        $suffix = "FSS";
                        break;
                    case "CTR":
                        $typeExt = "Center";
                        $suffix = "CTR";
                        break;
                }

                // Let's update the info!
                $_fac->navdata_airport_id = $_a->navdata_airport_id;
                $_fac->name = $_a->name." ".$typeExt;
                $_fac->type = $freq[3];
                $_fac->save();

                // Now, let's sort the position out!
                try {
                    $_pos = FacilityPosition::where("facility_id", "=", $_fac->facility_id)->where("callsign", "=", $_a->icao."_".$suffix)->firstOrFail();
                } catch(Exception $e){
                    $_pos = new FacilityPosition;
                }

                $_pos->facility_id = $_fac->facility_id;
                $_pos->callsign = $_a->icao."_".$suffix;
                $_pos->frequency = $freq[5];
                $_pos->save();
            }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}

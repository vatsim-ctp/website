<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Models\Flight;
use \Models\Api\Account as ApiAccount;
use \Models\Vdata\Airport;
use \Models\Vdata\Aircraft;
use \Models\Vdata\Airline;

class VatbookImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vatbook:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all vatbook bookings.';

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
            //$bookings = file("http://vatbook.euroutepro.com/ext_rmt_planned.php?t1=201406080001&t2=201406090000");
            $bookings = file("http://vatbook.euroutepro.com/ext_rmt_planned.php");
            foreach($bookings as $b){
                $b = strip_tags($b);
                $b = str_getcsv($b, ",", "");

                if(count($b) < 2){
                    continue;
                }

                // We need the fpid!
                $fpid = 0;
                preg_match("/fpid\=([0-9]+)/i", $b[10], $matches);
                $fpid = isset($matches[1]) ? $matches[1] : 0;

                // Attempt to get the route!
                $route = file_get_contents("http://vatbook.euroutepro.com/status.php?fpid=".$fpid);
                preg_match("/\<li\>route: (.*?)\<\/li\>/i", $route, $matches);
                $route = isset($matches[1]) ? $matches[1] : "";

                // Find or create?{
                try {
                    $_f = Flight::where("hash", "=", sha1("vatbook-".$fpid))->firstOrFail();
                } catch(Exception $e){
                    $_f = new Flight;
                }

                // Arrival and departure dates
                $dep = strtotime($b[1]." ".$b[5] . " GMT");
                $arr = strtotime($b[1]." ".$b[5] . " GMT");
                if($dep >= $arr){
                    $arr+= (24*60*60);
                }

                // Calculate enroute time.
                $enRoute = $arr-$dep;
                $enRoute = round($enRoute/60, 0);

                $_f->callsign = $b[2];
                $_f->navdata_aircraft_id = Aircraft::where("icao", "=", $b[9])->first()->id;
                $_f->departure_id = Airport::where("icao", "=", $b[3])->first()->id;
                $_f->departure_date = gmdate("Y-m-d", $dep);
                $_f->departure_time = gmdate("H:i:s", $dep);
                $_f->arrival_id = Airport::where("icao", "=", $b[4])->first()->id;
                $_f->arrival_date = gmdate("Y-m-d", $arr);
                $_f->arrival_time = gmdate("H:i:s", $arr);
                $_f->enroute_time = $enRoute; // In minutes.
                $_f->route = $route;
                $_f->hash = sha1("vatbook-".$fpid);
                $_f->api_account_id = ApiAccount::where("name", "LIKE", "VATBOOK-IMPORT")->first()->id;
                $_f->save();
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

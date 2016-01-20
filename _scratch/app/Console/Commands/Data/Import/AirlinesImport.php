<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Models\Vdata\Airline;

class AirlinesImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'airlines:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all airline data from the Euroscope data files.';

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
            $airlines = file(app_path()."/storage/meta/ICAO_Airlines.txt");
            foreach($airlines as $a){
                $a = str_getcsv($a, "\t", "");

                // Find or create?{
                try {
                    $_a = Airline::where("icao", "=", $a[0])->firstOrFail();
                } catch(Exception $e){
                    $_a = new Airline;
                }

                $a[1] = explode(" - ", $a[1]);
                $a["1a"] = $a[1][0];
                $a["1b"] = isset($a[1][1]) ? $a[1][1] : null;

                $_a->icao = strtoupper($a[0]);
                $_a->name = ucfirst(strtolower($a["1a"]));
                //$_a->country_id = ucfirst(strtolower($a["1b"]));
                $_a->callsign = $a[2];
                $_a->save();
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

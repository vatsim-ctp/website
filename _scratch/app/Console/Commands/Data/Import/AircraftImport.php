<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Models\Vdata\Aircraft;

class AircraftImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'aircraft:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all aircraft data from OpenAirports.';

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
            $aircraft = file(app_path()."/storage/meta/ICAO_Aircraft.txt");
            foreach($aircraft as $a){
                $a = str_getcsv($a, "\t", "");

                // Find or create?{
                try {
                    $_a = Aircraft::where("icao", "=", $a[0])->firstOrFail();
                } catch(Exception $e){
                    $_a = new Aircraft;
                }

                $_a->icao = strtoupper($a[0]);
                $_a->manufacturer = ucfirst(strtolower($a[2]));
                $_a->name = $a[3];
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

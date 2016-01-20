<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Models\Country;

class CountriesImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'countries:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all countries from the OurAirports datafeed.';

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
            $countries = file("http://ourairports.com/data/countries.csv");
            foreach($countries as $c){
                $c = str_getcsv($c);
                if($c[0] == "id"){ continue; }
                
                // Find or create?{
                try {
                    $_c = Country::where("code", "=", $c['1'])->firstOrFail();
                } catch(Exception $e){
                    $_c = new Country;
                }
                
                $_c->code = $c[1];
                $_c->name = $c[2];
                $_c->continent = $c[3];
                $_c->save();
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

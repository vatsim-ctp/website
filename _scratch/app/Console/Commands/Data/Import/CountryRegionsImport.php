<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Models\Country;
use \Models\Region;

class CountryRegionsImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'countries:regions:import';

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
            $regions = file("http://ourairports.com/data/regions.csv");
            foreach($regions as $r){
                $r = str_getcsv($r);
                if($r[0] == "id"){ continue; }
                
                // Try and find a country for this region.
                try {
                    $_c = Country::where("code", "=", $r['5'])->firstOrFail();
                } catch(Exception $e){
                    continue;
                }      
                
                // Find or create?{
                try {
                    $_r = Region::where("code", "=", $r['2'])->where("country_id", "=", $_c->country_id)->firstOrFail();
                } catch(Exception $e){
                    $_r = new Region;
                }
                
                $_r->country_id = $_c->country_id;
                $_r->code = $r[2];
                $_r->name = $r[3];
                $_r->save();
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

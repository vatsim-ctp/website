<?php namespace CTP\Console\Commands\Data\Import;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use CTP\Data\Vdata\Airport as AirportData;
use CTP\Data\I18n\Country as CountryData;

class Airports extends \CTP\Console\Commands\ConsoleCommand {

    protected $name        = 'import:data:airports';
    protected $description = 'Import all airport data from our data sources.';

    public function __construct() {
        parent::__construct();
    }

    public function fire() {
        if($this->argument("source") == "vataware"){
            $this->vataware();
        } elseif($this->argument("source") == "ourairports"){
            $this->ourairports();
        }
    }

    private function vataware() {
        $fh = fopen(storage_path()."/data/vataware/airports.csv", "r");
        $headers = fgetcsv($fh);

        while($line = fgetcsv($fh)){
            $a = array_combine($headers, $line);

            $a['icao'] = preg_match("/\w{4}/", $a['icao']) ? $a['icao'] : null;

            $apt = AirportData::firstOrNew(["icao" => $a['icao']]);

            $apt->iata = $a['iata'];
            $apt->name = $a['name'];
            $apt->latitude = $a['lat'];
            $apt->longitude = $a['lon'];
            $apt->elevation = $a['elevation'];
            $apt->type = $a['type'];
            $apt->save();
        }

        fclose($fh);
    }

    private function ourairports() {
        $airports = file("http://ourairports.com/data/airports.csv");
        foreach($airports as $apt) {
            $apt = str_getcsv($apt);
            if($apt[0] == "id") {
                continue;
            } // Get rid of first row.

            // Find or create?{
            try {
                $_a = Airport::where("icao", "LIKE", $apt[1])
                             ->firstOrFail();
            } catch(Exception $e) {
                $_a = new Airport;
            }

            if($_a->exists) {
                continue;
            } // We don't want to update current airfields!

            // Find the country, from the region!
            try {
                $reg = $apt[9]; // Country code first, needs to gotten rid of.
                $reg = substr($reg, 3);

                $_country = Country::where("code", "LIKE", $apt[8])
                                   ->firstOrFail()->country_id;
                $_region = Region::where("country_id", "=", $_country)
                                 ->where("code", "LIKE", $reg)
                                 ->firstOrFail()->country_region_id;
            } catch(Exception $ex) {
                $_country = 0;
                $_region = 0;
            }

            try {
                $_a->name = $apt[3];
                $_a->iata = ($apt[13] == "" ? null : strtoupper($apt[13]));
                $_a->icao = ($apt[1] == "" ? null : strtoupper($apt[1]));
                $_a->country_region_id = $_region;
                $_a->latitude = $apt[4];
                $_a->longitude = $apt[5];
                $_a->elevation = $apt[6];
                $_a->save();
            } catch(Exception $e) {
                continue;
            }
        }
    }

    protected function getArguments() {
        return [
            ["source", InputArgument::OPTIONAL, "The source, either [vataware, ourairports]", "ourairports"],
        ];
    }

    protected function getOptions() {
        return [
        ];
    }

}

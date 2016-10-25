<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;

class Airfield extends Model
{
    public $dates    = ['created_at', 'updated_at'];
    public $fillable = [
        "icao",
        "iata",
        "name",
        "latitude",
        "longitude",
        "timezone",
    ];

    public static function buildFromIcao($icao)
    {
        $csv = \League\Csv\Reader::createFromPath(database_path("airports.csv"));
        $airport = $csv
            ->addFilter(function ($row) use ($icao) {
                return strcasecmp($icao, $row[5]) == 0;
            })->fetchOne();

        return new Airfield([
            "icao"      => $icao,
            'iata'      => array_get($airport, 4, substr($icao, 1)),
            'name'      => array_get($airport, 1, "Unknown Airport " . $icao),
            'latitude'  => array_get($airport, 6, "0.0"),
            'longitude' => array_get($airport, 7, "0.0"),
            'timezone'  => array_get($airport, 11, "UTC"),
        ]);
    }

    public function scopeType($query, $type)
    {
        return $query->whereType($type);
    }

    public function scopeArrival($query)
    {
        return $query->type("arrival");
    }

    public function scopeDeparture($query)
    {
        return $query->type("departure");
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'airfield_id', 'id');
    }
}

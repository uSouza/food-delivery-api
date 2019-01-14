<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['city_id', 'name'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function freights()
    {
        return $this->hasMany(Freight::class);
    }
}

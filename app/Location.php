<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city', 'state', 'address', 'number', 'district',
        'postal_code', 'latitude', 'longitude', 'client_id', 'company_id'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
    /*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    */
}

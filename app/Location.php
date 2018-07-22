<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city', 'state', 'address', 'number', 'district',
        'postal_code', 'latitude', 'longitude', 'client_id', 'company_id'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function findLocationsByClient()
    {
        return Location::whereIn('locations.id', function ($query) {
            $client = Client::whereIn('clients.user_id', function ($query) {
                $query->select('users.id')
                    ->from('users')
                    ->where('users.id', auth()->id());
            })->get();
            $query->select('location_id')
                ->from('client_location')
                ->where('client_id', $client->first()->id);
        })->get();
    }

    public static function findLocationsByCompany()
    {
        return Location::whereIn('locations.id', function ($query) {
            $company = Company::whereIn('companies.user_id', function ($query) {
                $query->select('users.id')
                    ->from('users')
                    ->where('users.id', auth()->id());
            })->get();
            $query->select('location_id')
                ->from('company_location')
                ->where('company_id', $company->first()->id);
        })->get();
    }

}

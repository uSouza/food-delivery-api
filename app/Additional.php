<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = [
        'name', 'value', 'isDrink'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}

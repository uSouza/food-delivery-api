<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = ['description'];
/*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
*/
}

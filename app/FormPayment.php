<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = ['description', 'company_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = [
        'name', 'value', 'isDrink', 'company_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

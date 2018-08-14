<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'price', 'size', 'company_id'
    ];

    public function menus()
    {
        return $this->belongsToMany(Product::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

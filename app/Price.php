<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'price', 'size'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['description', 'observation', 'menu_id', 'price_id', 'ingredients_ids'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}

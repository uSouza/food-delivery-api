<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'ingredient_group_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function ingredient_group()
    {
        return $this->belongsTo(IngredientGroup::class);
    }
}
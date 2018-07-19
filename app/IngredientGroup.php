<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientGroup extends Model
{
    protected $fillable = ['name', 'number_options'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}

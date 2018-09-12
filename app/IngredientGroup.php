<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientGroup extends Model
{
    protected $fillable = ['name', 'number_options', 'value', 'company_id'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}

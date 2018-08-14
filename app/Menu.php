<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    protected $fillable = ['description', 'observation', 'company_id', 'prices_ids', 'ingredients_ids', 'date', 'url', 'image_base64'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function prices()
    {
        return $this->belongsToMany(Price::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}

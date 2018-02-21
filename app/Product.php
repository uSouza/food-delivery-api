<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['type', 'description', 'measure', 'size', 'company_id', 'ingredients_ids', 'tags_ids'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
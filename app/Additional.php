<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'value', 'isDrink', 'company_id'
    ];
    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

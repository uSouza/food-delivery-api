<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'cnpj', 'responsible_name', 'responsible_phone', 'user_id'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;
/*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipts::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
*/
}

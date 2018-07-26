<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $fillable = [
        'social_name', 'fantasy_name', 'cell_phone',
        'phone', 'cnpj', 'responsible_name',
        'responsible_phone', 'user_id', 'url', 'order_limit'
    ];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function additionals()
    {
        return $this->belongsToMany(Additional::class);
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
    public function workedDays()
    {
        return $this->hasOne(WorkedDays::class);
    }

}
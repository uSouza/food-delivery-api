<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $fillable = [
        'social_name', 'fantasy_name', 'cell_phone',
        'phone', 'cnpj', 'responsible_name',
        'responsible_phone', 'user_id', 'observation',
        'url', 'order_limit', 'opening_time', 'tags_ids',
        'delivery_value',
    ];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredient_groups()
    {
        return $this->belongsToMany(IngredientGroup::class);
    }

}
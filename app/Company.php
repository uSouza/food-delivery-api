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
        'delivery_value', 'avg_delivery_time', 'image_base64'
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

    public function form_payments()
    {
        return $this->hasMany(FormPayment::class);
    }

    public function additionals()
    {
        return $this->hasMany(Additional::class);
    }

    public function service_hours()
    {
        return $this->hasMany(ServiceHour::class);
    }

    public function worked_days()
    {
        return $this->hasMany(WorkedDays::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredient_groups()
    {
        return $this->hasMany(IngredientGroup::class);
    }

}
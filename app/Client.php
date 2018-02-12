<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $fillable = ['name', 'phone', 'cell_phone', 'user_id'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
/*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
*/
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = [
        'order_id', 'status_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

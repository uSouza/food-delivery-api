<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'sale_price', 'sale_discount', 'observation',
        'client_id', 'company_id', 'status_id',
        'form_payment_id', 'location_id'
    ];

    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function form_payment()
    {
        return $this->belongsTo(FormPayment::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function order_statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'price', 'observation', 'receive_at',
        'client_id', 'company_id', 'deliver', 'status_id',
        'form_payment_id', 'location_id', 'products_ids'
    ];

    protected $dates = ['deleted_at'];

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

    public function order_evaluations()
    {
        return $this->hasOne(OrderEvaluation::class);
    }

}

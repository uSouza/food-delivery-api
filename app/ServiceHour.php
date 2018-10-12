<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceHour extends Model
{
    protected $fillable = [
        'company_id', 'opening', 'closure'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

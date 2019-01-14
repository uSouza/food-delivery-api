<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    protected $fillable = [
      'district_id', 'company_id', 'value'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

}

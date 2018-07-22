<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkedDays extends Model
{
    protected $fillable = [
        'company_id', 'sunday', 'monday', 'tuesday',
        'wednesday', 'thursday', 'friday', 'saturday',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

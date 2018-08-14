<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'social_name', 'name', 'email', 'phone', 'message'
    ];
}

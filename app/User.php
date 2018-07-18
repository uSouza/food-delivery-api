<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.teste
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function client() {
        return $this->hasOne(Client::class);
    }

    public function isAdmin() {
        return $this->type === "admin";
    }

    protected $dispatchesEvents = [
      'created' => \App\Events\UserCreatedEvent::class
    ];
}

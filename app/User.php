<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\SocialAccount;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialAccount()
    {
        return $this->hasMany(SocialAccount::class);
    }
}

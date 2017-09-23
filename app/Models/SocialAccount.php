<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialAccount extends Model
{
    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFactory;

    protected $fillable = [
      'phone',
      'otp',
      'last_seen_at',
      'last_login_ip',
      'login_attempt',
      'block_attempt',
      'last_try_at',
    ];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\CustomerFactory::new();
    }
}

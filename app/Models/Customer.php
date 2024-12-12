<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable
{

    use HasApiTokens,  Notifiable, HasFactory;

    public function bookings(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Reservations\Entities\Reservation;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the active reservations related to the passenger
     */
    public function activeReservations()
    {
        return $this->hasMany(Reservation::class)
            ->where('departed_at', '<=', Carbon::now())
            ->where('arrived_at', '>', Carbon::now());
    }

    /**
     * Get all reservations related to the passenger
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
<?php

namespace Modules\Reservations\Entities;

use App\Models\CoreModel;
use App\Models\User;

class Reservation extends CoreModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'departed_at', 'arrived_at', 'user_id', 'payment_status', 'price'
    ];

    /**
     * Get the passenger who reserved
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Getter for the payment status
     */
    public function getPaymentStatusAttribute($value)
    {
        if ($value != '1') {
            return 'Paid';
        }
        return 'Unpaid';
    }
}
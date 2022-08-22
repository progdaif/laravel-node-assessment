<?php

namespace Modules\Reservations\Observers;

use Modules\Reservations\Entities\Reservation;
use App\Jobs\PaidEmailJob;

class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     *
     * @param  Reservation  $reservation
     * @return void
     */
    public function created(Reservation $reservation)
    {
        if ($reservation->payment_status == 'Paid') {
            $reservation->with('user');
            dispatch(new PaidEmailJob($reservation));
        }
    }

    /**
     * Handle the Reservation "updated" event.
     *
     * @param  Reservation  $reservation
     * @return void
     */
    public function updated(Reservation $reservation)
    {
        if ($reservation->payment_status == 'Paid') {
            $reservation->with('user');
            dispatch(new PaidEmailJob($reservation));
        }
    }
}
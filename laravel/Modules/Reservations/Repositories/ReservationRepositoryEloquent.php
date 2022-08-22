<?php

namespace Modules\Reservations\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Reservations\Entities\Reservation;

final class ReservationRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Reservation Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reservation::class;
    }

    /*
     * Boot up the repository
     *
     * @return void
     * */
    public function boot()
    {
        //
    }
}
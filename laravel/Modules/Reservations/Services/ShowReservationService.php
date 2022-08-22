<?php

namespace Modules\Reservations\Services;

use Modules\Reservations\Entities\Reservation;
use Modules\Reservations\Repositories\ReservationRepositoryEloquent;

final class ShowReservationService
{
    /**
     * The reservation main repository.
     *
     * @var ReservationRepositoryEloquent
     */
    private ReservationRepositoryEloquent $repository;

    /**
     * Load ReservationRepositoryEloquent as main repository
     *
     * @return void
     */
    public function __construct(ReservationRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show reservation
     *
     * @param int $reservationId
     * @param int $userId
     *
     * @return Reservation
     */
    public function show(int $reservationId, int $userId)
    {
        return $this->repository->where('id', $reservationId)
            ->where('user_id', $userId)->first();
    }
}
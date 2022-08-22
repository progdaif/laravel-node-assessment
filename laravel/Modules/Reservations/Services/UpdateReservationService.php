<?php

namespace Modules\Reservations\Services;

use Modules\Reservations\Entities\Reservation;
use Modules\Reservations\Repositories\ReservationRepositoryEloquent;

final class UpdateReservationService
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
     * Update reservation
     *
     * @param array $data
     * @param int $reservationId
     * @param int $userId
     *
     * @return Reservation
     */
    public function update(array $data, int $reservationId, int $userId)
    {
        return $this->repository->where('user_id', $userId)
            ->update($data, $reservationId);
    }
}
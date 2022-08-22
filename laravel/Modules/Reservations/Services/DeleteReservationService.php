<?php

namespace Modules\Reservations\Services;

use Modules\Reservations\Repositories\ReservationRepositoryEloquent;

final class DeleteReservationService
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
     * Delete reservation
     *
     * @param int $reservationId
     * @param int $userId
     *
     * @return bool
     */
    public function delete(int $reservationId, int $userId)
    {
        return $this->repository->where('id', $reservationId)
                ->where('user_id', $userId)->delete();
    }
}
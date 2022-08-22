<?php

namespace Modules\Reservations\Services;

use Modules\Reservations\Entities\Reservation;
use Modules\Reservations\Repositories\ReservationRepositoryEloquent;

final class CreateReservationService
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
     * Insert a new reservation
     *
     * @param array $data
     *
     * @return Reservation
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
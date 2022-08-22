<?php

namespace Modules\Reservations\Services;

use Modules\Reservations\Repositories\ReservationRepositoryEloquent;

final class GetReservationsService
{
    private $perPage = 10;
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
     * Get passenger reservations
     *
     * @param int $userId
     *
     * @return array
     */
    public function get(int $userId)
    {
        return $this->repository->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }
}
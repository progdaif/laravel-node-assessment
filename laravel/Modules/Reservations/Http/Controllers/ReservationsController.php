<?php

namespace Modules\Reservations\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Modules\Reservations\Http\Requests\CreateReservationRequest;
use Modules\Reservations\Http\Requests\UpdateReservationRequest;

use Modules\Reservations\Services\GetReservationsService;
use Modules\Reservations\Services\ShowReservationService;
use Modules\Reservations\Services\CreateReservationService;
use Modules\Reservations\Services\UpdateReservationService;
use Modules\Reservations\Services\DeleteReservationService;

use Throwable;

class ReservationsController extends Controller
{
    /**
     * Display paginated list of reservations
     * @return Renderable
     */
    public function index(GetReservationsService $service)
    {
        try {
            $userId = Auth::id();
            $reservations = $service->get($userId);
            $this->successResponse(
                $reservations,
                "Latest reservations was retreived successfully",
                200
            );
        } catch (Throwable $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(ShowReservationService $service, int $id)
    {
        try {
            $userId = Auth::id();
            $reservation = $service->show($id, $userId);
            $this->successResponse(
                $reservation,
                "Reservation was retreived successfully",
                200
            );
        } catch (Throwable $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(
        CreateReservationRequest $request,
        CreateReservationService $service
    )
    {
        try {
            $reservationData = $request->only(
                'departed_at',
                'arrived_at',
                'payment_status',
                'price'
            );
            $userId = Auth::id();
            $reservationData['user_id'] = $userId;
            $service->create($reservationData);
            $this->successResponse(
                [],
                "Reservation was created successfully",
                201
            );
        } catch (Throwable $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(
        UpdateReservationRequest $request,
        UpdateReservationService $service,
        int $id
    ) {
        try {
            $reservationData = $request->only(
                'departed_at',
                'arrived_at',
                'payment_status',
                'price'
            );
            $userId = Auth::id();
            $service->update($reservationData, $id, $userId);
            $this->successResponse(
                [],
                "Reservation was updated successfully",
                204
            );
        } catch (Throwable $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteReservationService $service, int $id)
    {
        try {
            $userId = Auth::id();
            $service->delete($id, $userId);
            $this->successResponse(
                [],
                "Reservation was deleted successfully",
                204
            );
        } catch (Throwable $e) {
            return $this->throwError($e);
        }
    }
}
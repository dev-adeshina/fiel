<?php

namespace App\Http\Controllers\Reservation;

use App\Domains\Reservation\Actions\UpdateReservationStatusAction;
use App\Domains\Reservation\Models\Reservation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\UpdateReservationStatusRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;



class AdminReservationController extends Controller
{
    public function index()
    {
        return ReservationResource::collection(Reservation::latest()->paginate());
    }

    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation, UpdateReservationStatusAction $action) 
    {

        $reservation = $action->execute($reservation, $request->status);

        return new ReservationResource($reservation);
    }
}

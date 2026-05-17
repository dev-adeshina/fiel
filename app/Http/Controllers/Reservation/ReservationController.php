<?php

namespace App\Http\Controllers\Reservation;

use App\Domains\Reservation\Actions\CreateReservationAction;
use App\Domains\Reservation\Models\Reservation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;



class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()->latest()->get();

        return ReservationResource::collection($reservations);
    }

    public function store(StoreReservationRequest $request, CreateReservationAction $action) 
    {

        $reservation = $action->execute(auth()->user(), $request->validated());

        return new ReservationResource($reservation);
    }

    public function show(Reservation $reservation) 
    {

        abort_if($reservation->user_id !== auth()->id(), 403);

        return new ReservationResource($reservation->load('table'));
    }
}

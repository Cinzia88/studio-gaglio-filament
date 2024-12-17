<?php

namespace App\Http\Controllers\API\Bookings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Slot;
use Illuminate\Http\JsonResponse;

class BookingsApp extends Controller
{
    public function show($serviceId): JsonResponse
    {

            $bookings = Booking::where('service_id', $serviceId)->get();

        //$bookings = Booking::orderBy('id', 'desc')->paginate(5);
        $slots = Slot::all();
        return response()->json([
          'slots' =>  $slots,
          'bookings' => $bookings,
        ]);
    }

    public function index(Request $request)
    {
        $bookings_user = Booking::where('customer_id', $request->id)->orderBy('id', 'desc')->get();
        return $bookings_user;
    }

    public function store(Request $request) {
        $requestBoookingData = $request->validate([
            'customer_id' => ['required',],
            'service_id' => ['required',],
            'slot_id' => ['required',],
            'data' => ['required', 'string'],
            'messaggio' => ['nullable', 'string'],
        ]);
        $customerIdData = Customer::find($requestBoookingData['customer_id'],);
        $serviceIdData = Service::find($requestBoookingData['service_id'],);
        $slotIdData = Slot::find($requestBoookingData['slot_id'],);

        $requestBooking = Booking::create([
            'customer_id' => $customerIdData->id,
            'service_id' => $serviceIdData->id,
            'slot_id' => $slotIdData->id,
            'data' => $requestBoookingData['data'],
            'messaggio' => $requestBoookingData['messaggio'],
        ]);



        return response()->json([
            'data' => $requestBooking,
        ]);

    }

    public function destroy(Request $request) {
        $booking = Booking::find($request->id);
        $booking->delete();
        return 'Prenotazione Rimossa Con Successo';
    }
}

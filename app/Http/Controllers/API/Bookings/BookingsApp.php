<?php

namespace App\Http\Controllers\API\Bookings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Slot;

class BookingsApp extends Controller
{
    public function show()
    {
        $bookings = Booking::orderBy('id', 'desc')->paginate(5);
        return $bookings;
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
        $post = Booking::find($request->id);
        $post->delete();
        return 'Post Rimosso Con Successo';
    }
}

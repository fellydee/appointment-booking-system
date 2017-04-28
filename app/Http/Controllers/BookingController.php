<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Business;
use App\Employee;
use App\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Process the booking that is being made
     *
     * @param Request $request
     */
    public function processBooking(Request $request)
    {
        $booking = Booking::create([
            'user_id' => $request->user()->id, //TODO fake this when owner is doing for customer
            'business_id' => $request['business_id'],
            'employee_id' => $request{'employee_id'},
            'service_id' => $request['employee_id'],
            'date' => strftime('%F', strtotime($request['date'])),
            'time' => strftime('%T', strtotime($request['time']))
        ]);
        return view('booking.complete',compact('booking'));
    }


    public function index()
    {
        $businesses = Business::all();
        return view('booking.index', compact('businesses'));
    }

    public function showService($id)
    {
        $service = Service::where('id', $id)->first();
        $business = Business::where('id', $service->business_id)->first();
        return view('booking.selectEmployee', compact(['service', 'business']));
    }


    public function showEmployee($service_id, $employee_id)
    {
        $service = Service::where('id', $service_id)->first();
        $employee = Employee::where('id', $employee_id)->first();
        return view('booking.book', compact(['service', 'employee']));
    }
}

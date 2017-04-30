<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Business;
use App\Employee;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role']);
    }

    /**
     * Process the booking that is being made
     *
     * @param Request $request
     */
    public function processBooking(Request $request)
    {
        if (empty(session('customer_id'))) {
            $id = $request->user()->id;
        } else {
            $id = session('customer_id');
        }
        $booking = Booking::create([
            'user_id' => $id,
            'business_id' => $request['business_id'],
            'employee_id' => $request{'employee_id'},
            'service_id' => $request['service_id'],
            'date' => strftime('%F', strtotime($request['date'])),
            'time' => strftime('%T', strtotime($request['time']))
        ]);
        return view('booking.complete', compact('booking'));
    }

    public function setCustomer(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|alpha|min:1|max:60',
            'last_name' => 'required|alpha|min:1|max:60',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10',
            'address' => 'required|max:80'
        ]);
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'password' => bcrypt($request['email']),
            'role' => 1
        ]);
        session()->put('customer_id', $user->id);
        $business = $request->user()->business;
        return view('booking.serviceSelect', compact('business'));
    }

    public function index()
    {
        if (isset(Auth::user()->business_id)) {
            $business = Auth::user()->business;
            $users = User::all(); // Not sure if should exclude business owners
            return view('booking.forCustomer', compact('business', 'users'));
        }
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

    public function viewBooking($id)
    {
        if (!empty(session('customer_id'))) {
            session()->forget('customer_id');
        }
        $booking = Booking::where('id', $id)->first();
        return view('booking.view', compact('booking'));
    }
}

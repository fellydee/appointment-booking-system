<?php

namespace App\Http\Controllers;

use App\Business;
use App\Employee;
use App\EmployeeService;
use App\Service;
use App\Timeslot;
use App\User;
use App\Booking;
use App\Http\Controllers\Controller;
use function foo\func;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web', 'auth']);

    }
//    public function myBookings()
//    {
//        $user = Auth::user();
//        if($user->role == 0) {
//            $bookings = Booking::where('business_id', $user->business_id)->get();
//            return $bookings;
//        }else{
//            $bookings = Booking::where('user_id',Auth::id())->get();
//            return $bookings;
//        }
//    }

    public function myBookings()
    {
        $user = Auth::user();
        $booking = Booking::where('user_id', Auth::id())->get();
    }


    private function processBooking($booking)
    {


    }

    public function getBusinessInfo($id)
    {
        return Business::with(['businesshours', 'service'])
            ->where('id', $id)->get();
    }


    public function getEmployeeHours($id)
    {
        return Timeslot::where('employee_id', $id)->get();
    }

    public function getBusinesses()
    {
        return Business::all();
    }

    public function test()
    {
        return Employee::with(['timeslot', 'service'])->get();
    }


    public function getAvailableTimes($id, $date)
    {
        $employee = Employee::where('id', $id)->first();
        $dayNum = date('w', strtotime($date)) - 1;
        if ($dayNum < 0 || $dayNum > 6) {
            return "ERROR";
        }
        if (!$employee->isWorking($date)) {
            return response()->json([
                'error' => 'Not working that day'
            ]);
        }
        $times = $employee->timesAvailable($date);
        if (count($times) == 0) {
            return response()->json([
                'error' => 'All booked for that day'
            ]);
        }

        // Format the times
        $formattedTimes = array();
        foreach ($times as $time) {
            array_push($formattedTimes,date("g:i A", strtotime($time)));
        }
        return $formattedTimes;
    }


}
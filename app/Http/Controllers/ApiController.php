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
        $bookings = array();
        foreach ($user->bookings as $booking) {
            array_push($bookings, $booking->fullCalendarFormat());
        }
        return $bookings;
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
        $business = Business::where('id', $id)->first();

        $formatted = array();
        foreach ($business->employees as $employee) {
            foreach ($employee->timeslots as $timeslot) {
                array_push($formatted, $timeslot->fullCalendarFormat());
            }
        }


        return $formatted;
    }

    public function getBusinesses()
    {
        return Business::all();
    }

    public function test()
    {
        return Timeslot::all()[0]->fullCalendarFormat();
    }


    public function getAvailableTimes($employee_id, $service_id, $date)
    {
        $employee = Employee::where('id', $employee_id)->first();
        $service = Service::where('id', $service_id)->first();
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

        $serviceTimes = array();

        // Remove all slots that cannot support the service length
        $slotsRequired = $service->duration / 30;
        if ($slotsRequired > 1) {
            foreach ($times as $time) {
                $valid = true;
                for ($i = 0; $i < $slotsRequired; $i++) {
                    $current = $current = date("H:i:s", strtotime("+30 minutes", strtotime($time)));
                    $val = array_search($current, $times);
                    if ($val == false) {
                        $valid = false;
                    }

                }
                if ($valid == true) {
                    array_push($serviceTimes, $time);
                }
            }
        } else {
            $serviceTimes = $times;
        }

        // Format the times
        $formattedTimes = array();
        foreach ($serviceTimes as $time) {
            array_push($formattedTimes, date("g:i A", strtotime($time)));
        }
        return $formattedTimes;
    }


}
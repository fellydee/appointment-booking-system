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

    /**
     * Returns all bookings for the current logged in user
     * @return array
     */
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = array();
        // Formats the bookings to be displayed in full calendar
        foreach ($user->bookings as $booking) {
            array_push($bookings, $booking->fullCalendarFormatCustomer());
        }
        return $bookings;
    }

    /**
     * Returns the all information for the given business id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBusinessInfo($id)
    {
        return Business::with(['businesshours', 'service'])
            ->where('id', $id)->get();
    }

    /**
     * Returns each employees hours as a in full calendar format
     * @param $business_id
     * @return array
     */
    public function getAllEmployeeHours($business_id)
    {
        $business = Business::where('id', $business_id)->first();

        $formatted = array();
        foreach ($business->employees as $employee) {
            foreach ($employee->timeslots as $timeslot) {
                array_push($formatted, $timeslot->fullCalendarFormat());
            }
        }

        return $formatted;
    }

    /**
     * Return all bookings for a given business id in full calendar format
     * @param $business_id
     * @return array
     */
    public function getAllBookings($business_id)
    {
        $bookings = Booking::where('business_id', $business_id)->get();
        $formatted = array();
        foreach ($bookings as $booking) {
            array_push($formatted, $booking->fullCalendarFormatOwner());
        }

        return $formatted;
    }

    /**
     * Return the hours for the given employee
     * @param $employee_id
     * @return mixed
     */
    public function getEmployeeHours($employee_id)
    {
        $employee = Employee::where('id', $employee_id)->first();

        return $employee->timeslots;
    }

    /**
     * Returns all the businesses
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBusinesses()
    {
        return Business::all();
    }

    /**
     * A Test function for testing
     * @return mixed
     */
    public function test()
    {
        return Timeslot::all()[0]->fullCalendarFormat();
    }

    /**
     * Returns all the times a employee can do the given service on the given date
     * @param $employee_id
     * @param $service_id
     * @param $date
     * @return array|\Illuminate\Http\JsonResponse|string
     */
    public function getAvailableTimes($employee_id, $service_id, $date)
    {
        // Get the employee and service
        $employee = Employee::where('id', $employee_id)->first();
        $service = Service::where('id', $service_id)->first();

        // Convert the date from eg monday to 0 and ensure is valid
        $dayNum = date('w', strtotime($date)) - 1;
        if ($dayNum < 0 || $dayNum > 6) {
            return response()->json([
                'error' => 'Date not valid'
            ]);
        }
        // Check the employee is working that date
        if (!$employee->isWorking($date)) {
            return response()->json([
                'error' => 'Not working that day'
            ]);
        }
        // Get the times the employee is available
        $times = $employee->timesAvailable($date);
        if (count($times) == 0) {
            return response()->json([
                'error' => 'All booked for that day'
            ]);
        }

        $serviceTimes = array();

        // Remove all slots that cannot support the service length
        $slotsRequired = $service->duration / 30;

        // For each of the times the employee is available remove slots that cannot support the service
        foreach ($times as $time) {
            $validTime = true;
            for ($i = 0; $i < $slotsRequired-1; $i++) {
                $current = date("H:i:s", strtotime("+" . ($i+1)*30 . " minutes", strtotime($time)));
                if(array_search($current,$times) == false){
                    $validTime = false;
                }
            }
            if($validTime){
                array_push($serviceTimes,$time);
            }
        }

        // Format the times
        $formattedTimes = array();
        foreach ($serviceTimes as $time) {
            array_push($formattedTimes, date("g:i A", strtotime($time)));
        }

        return $formattedTimes;
    }


}
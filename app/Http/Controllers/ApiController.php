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
        $this->middleware(['web','auth']);

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



    private function processBooking($booking){


    }

    public function getBusinessInfo($id){
        return Business::with(['businesshours','service'])
            ->where('id',$id)->get();
    }


    public function getEmployeeHours($id){
        return Timeslot::where('employee_id',$id)->get();
    }

    public function getBusinesses(){
        return Business::all();
    }

    public function test(){
        return Employee::with(['timeslot','service'])->get();
    }


    public function getAvailableTimes($id, $date){
        // Check that the service exists
        $service = Service::where('id',$id)->first();
        if($service == null){
            return "ERROR Service does not exist";
        }
        // Check the business exists
        $business = Business::where('id', $service->business_id)->first();
        if($business == null) {
            return "ERROR Business not found";
        }
        // TODO Validate the date
        // Get employees that are working on that day
        $dayNum = date('w', strtotime($date)) - 1;
        if($dayNum < 0 || $dayNum > 6){
            return "ERROR";
        }



        // Get available times for that service on that day
        // Depends on:
            // Open hours
            // Other bookings
            // Employee aval + able to complete service
            // Duration fits
    }


}
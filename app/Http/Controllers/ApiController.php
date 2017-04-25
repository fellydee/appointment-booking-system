<?php

namespace App\Http\Controllers;

use App\Business;
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
        return Business::with('businesshours')->get();
    }

}
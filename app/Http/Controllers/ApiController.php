<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web','auth']);

    }
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id',Auth::id())->get();
        return $bookings;
    }
}
<?php

namespace App\Http\Controllers;

use App\Business;
use App\Employee;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $businesses = Business::all();
        return view('booking.index', compact('businesses'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Business;
use App\Employee;
use App\Service;
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

    public function show($id){
        $service = Service::where('id',$id)->first();
        $business = Business::where('id',$service->business_id)->first();
        return view('booking.show',compact(['service','business']));
    }

}

<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    /**
     * Returns the admin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Clears the booking for customer information
        if (!empty(session('customer_id'))) {
            session()->forget('customer_id');
        }
        $business = Business::where('id',Auth::user()->business_id)->first();
        return view('admin.index',compact('business'));
    }
}

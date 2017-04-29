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

    public function index()
    {
        if (!empty(session('customer_id'))) {
            session()->forget('customer_id');
        }
        $business = Business::where('id',Auth::user()->business_id)->first();
        return view('admin.index',compact('business'));
    }
}

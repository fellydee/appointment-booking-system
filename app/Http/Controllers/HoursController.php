<?php

namespace App\Http\Controllers;

use App\BusinessHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoursController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role']);
    }

    /**
     * Show the hours editor page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin/hours', compact('user'));
    }

    public function store(Request $request)
    {
        // Validate request
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

        for ($i = 0; $i < count($days); $i++) {
            if(isset($request[$days[$i] . '_start'])){
                $start = $request[$days[$i] . '_start'];
                if($start == 'null'){
                    continue;
                }
                if(isset($request[$days[$i] . '_end'])){
                    $end = $request[$days[$i] . '_end'];
                    // Check that end time is greater than the start time
                    if(strtotime($end) > strtotime($start)){
                        continue;
                    }
                }
            }
            session()->flash('error','An error occurred when processing your request, please try again');
            return redirect('/hours');
        }


        BusinessHours::where('business_id', $request->user()->business_id)->delete(); // Remove all old hour records
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        for ($i = 0; $i < count($days); $i++) {
            if ($request[$days[$i] . '_start'] != "null") {
                BusinessHours::create([
                    'business_id' => $request->user()->business_id,
                    'day' => $i,
                    'open_time' => strftime('%T', strtotime($request[$days[$i] . '_start'])),
                    'close_time' => strftime('%T', strtotime($request[$days[$i] . '_end']))
                ]);
            }
        }
        session()->flash('status','Business hours have been saved');
        return redirect('/admin');
    }


}

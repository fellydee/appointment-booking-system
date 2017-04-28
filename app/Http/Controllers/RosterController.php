<?php

namespace App\Http\Controllers;

use App\BusinessHours;
use App\Roster;
use App\Timeslot;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function store(Request $request)
    {
<<<<<<< HEAD
        $user = Auth::user();
=======
        // Validate request
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $businessHours = BusinessHours::where('business_id', $request->user()->business_id)->get();

        for ($i = 0; $i < count($days); $i++) {
            if (!isset($request[$days[$i] . '_start'])) {
                continue;
            }

            $start = $request[$days[$i] . '_start'];
            if ($start == 'notworking') {
                continue;
            }
            if (isset($request[$days[$i] . '_end'])) {
                $end = $request[$days[$i] . '_end'];
                // Check that end time is greater than the start time
                if (strtotime($end) > strtotime($start)) {
                    // Check timeslot is within hours=
                    if (strtotime($start) >= strtotime($businessHours[$i]->open_time) && strtotime($end) <= strtotime($businessHours[$i]->close_time)) {
                        continue;
                    }
                }
            }
            session()->flash('error', 'An error occurred when processing your request, please try again');
            return redirect()->back();
>>>>>>> e19bfca4381431c4f56530d0cbb016e4e109e595

        }
        Timeslot::where('employee_id', $request['employeeid'])->delete(); // Remove all old hour records
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        for ($i = 0;
             $i < count($days);
             $i++) {
            if (!isset($request[$days[$i] . '_start'])) {
                continue;
            }

            if ($request[$days[$i] . '_start'] != "notworking") {
                Timeslot::create([
                    'employee_id' => $request['employeeid'],
                    'day' => $i,
                    'start_time' => strftime('%T', strtotime($request[$days[$i] . '_start'])),
                    'end_time' => strftime('%T', strtotime($request[$days[$i] . '_end']))
                ]);
            }
        }
        session()->flash('status', 'Employee hours have been saved');
        return redirect()->back();
    }

    public
    function update(Request $request)
    {
        $this->validate($request, [
            ''
        ]);
    }
}

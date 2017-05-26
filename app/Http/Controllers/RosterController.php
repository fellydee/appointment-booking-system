<?php

namespace App\Http\Controllers;

use App\BusinessHours;
use App\Roster;
use App\Timeslot;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    /**
     * Validates and stores the roster information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request);

        // Validate request
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $businessHours = BusinessHours::where('business_id', $request->user()->business_id)->get();

//        dd($businessHours);

//        for ($i = 0; $i < count($days); $i++) {
//            // If the start combo is not set it means the value is disabled meaning the business is closed
//            if (!isset($request[$days[$i] . '_start'])) {
//                continue;
//            }
//            // If the employee is notworking don't continue validating.
//            $start = $request[$days[$i] . '_start'];
//            if ($start == 'notworking') {
//                continue;
//            }
//            if (isset($request[$days[$i] . '_end'])) {
//                $end = $request[$days[$i] . '_end'];
//                // Check that end time is greater than the start time
//                if (strtotime($end) > strtotime($start)) {
//                    // Check timeslot is within hours=
//                    if (strtotime($start) >= strtotime($businessHours[$i]->open_time) && strtotime($end) <= strtotime($businessHours[$i]->close_time)) {
//                        continue;
//                    }
//                }
//            }
//            session()->flash('error', 'An error occurred when processing your request, please try again');
//            return redirect()->back();
//
//
//        }
        // Store the timeslots
        Timeslot::where('employee_id', $request['employeeid'])->delete(); // Remove all old hour records
        for ($i = 0; $i < count($days); $i++) {
            // If the start combo is not set it means the value is disabled meaning the business is closed
            if (!isset($request[$days[$i] . '_start'])) {
                continue;
            }
            // If the employee is notworking don't save the timeslot
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

}

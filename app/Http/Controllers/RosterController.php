<?php

namespace App\Http\Controllers;

use App\Roster;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function store(Request $request)
    {

        $user = Auth::user();

        Roster::where('business_id', $user->business_id)->delete(); // Remove all old hour records
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        for ($i = 0; $i < count($days); $i++) {
            if ($request[$days[$i] . '_start'] != "null") {
                BusinessHours::create([
                    'business_id' => $user->business_id,
                    'day' => $i,
                    'open_time' => strftime('%T', strtotime($request[$days[$i] . '_start'])),
                    'close_time' => strftime('%T', strtotime($request[$days[$i] . '_end']))
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            ''
        ]);
    }
}

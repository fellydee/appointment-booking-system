<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            ''
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            ''
        ]);
    }
}

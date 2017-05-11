<?php

namespace App\Http\Controllers;

use App\Business;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Returns the superadmin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->where('role', '1')->get();
        return view('superadmin', compact('users'));
    }

    /**
     * From the request creates a new business and applies it to the user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required|unique:businesses',
            'phone' => 'required|digits:10|unique:businesses',
            'email' => 'required|unique:businesses'
        ]);

        $business = Business::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email')
        ]);

        // Apply the new business to the business owner user
        $user = User::where('id', $request->get('owner'))->first();
        $user->role = 0;
        $user->business_id = $business->id;
        $user->save();

        session()->flash('status', 'Business Created');
        return redirect('/super');
    }
}

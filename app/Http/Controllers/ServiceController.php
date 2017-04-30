<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Employee;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role', 'auth']);
    }

    public function index()
    {
        $services = Service::where('business_id', Auth::user()->business_id)->get();
        return view('service.index', compact('services'));
    }

    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required'
        ]);

        Service::create([
            'business_id' => $request->user()->business_id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'duration' => $request->get('duration'),
            'price' => $request->get('price')
        ]);

        return redirect('/services');
    }

    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required'
        ]);

        $service->title = $request->get('title');
        $service->description = $request->get('description');
        $service->duration = $request->get('duration');
        $service->price = $request->get('price');

        $service->save();

        return redirect('/services/');
    }

    public function destroy(Service $service)
    {
        if ($service === null) {
            session()->flash('error', 'There was a problem removing the service');
            return redirect('/services');
        }
        // Check there are no bookings using that service
        $bookings = Booking::where('service_id', $service->id)->get();
        if (count($bookings) != 0) {
            session()->flash('error','Service cannot be removed, there are bookings for this service');
        } else {
            $service->employees()->detach();
            $service->delete();
        }

        return redirect('/services');
    }

    public
    function assign(Request $request)
    {
        $employee = Employee::find($request->get('employee'));
        $service = Service::find($request->get('service'));

        $employee->services()->attach($service);

        return redirect()->back();
    }

    public
    function unassign(Request $request)
    {
        $employee = Employee::find($request->get('employee'));
        $service = Service::find($request->get('service'));
        $bookings = $employee->bookings->where('service_id', $service->id);
        if (count($bookings) != 0) {
            session()->flash('error', 'Service cannot be removed. There are bookings present for this employee and service.');
        } else {
            $employee->services()->detach($service);
        }

        return redirect()->back();
    }
}

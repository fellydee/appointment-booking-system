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

    /**
     * Returns the main service page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $services = Service::where('business_id', Auth::user()->business_id)->get();
        return view('service.index', compact('services'));
    }

    /**
     * Returns a page showing info for the given service
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    /**
     * Returns the page to create a new service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Validates and stores a new service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Returns the edit page for the given service
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    /**
     * Updates the given service with the given information
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Destroy the given service
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Service $service)
    {
        // Check a service was found
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

    /**
     * Assign an employee to a service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assign(Request $request)
    {
        $employee = Employee::find($request->get('employee'));
        $service = Service::find($request->get('service'));
        // Attachs an employee to the service and vise versa
        $employee->services()->attach($service);

        return redirect()->back();
    }

    /**
     * Unassign an employee to a service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unassign(Request $request)
    {
        $employee = Employee::find($request->get('employee'));
        $service = Service::find($request->get('service'));
        $bookings = $employee->bookings->where('service_id', $service->id);

        // Check that the employee and the service do not have any bookings
        if (count($bookings) != 0) {
            session()->flash('error', 'Service cannot be removed. There are bookings present for this employee and service.');
        } else {
            // Detaches an employee to the service and vise versa
            $employee->services()->detach($service);
        }

        return redirect()->back();
    }
}

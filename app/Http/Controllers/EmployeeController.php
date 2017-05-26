<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    /**
     * Returns the main employee management page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Gets the employees of the currently logged in business owner
        $employees = Employee::where('business_id',Auth::user()->business_id)->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Returns a page showing a single employees details
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Employee $employee)
    {
        // Gets all services the business offers that the employee does not
        $services = Service::whereDoesntHave('employees', function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        })->where('business_id',$employee->business_id)->get();

        return view('employee.show', compact('employee', 'services'));
    }

    /**
     * Returns the create employee page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Returns the edit employee page
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    /**
     * Validated the create request and saved to the database and redirects
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|alpha|min:1|max:60',
            'last_name' => 'required|alpha|min:1|max:60',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|digits:10',
            'address' => 'required|max:80'
        ]);
        $employee = new Employee([
            'business_id' => $request->user()->business_id,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address')
        ]);

        $employee->save();

        return redirect('/employees');
    }

    /**
     * updates the given employee with the given information
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'first_name' => 'required|alpha|min:1|max:60',
            'last_name' => 'required|alpha|min:1|max:60',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'phone' => 'required|digits:10',
            'address' => 'required|max:80'
        ]);

        $employee->first_name = $request->get('first_name');
        $employee->last_name = $request->get('last_name');
        $employee->email = $request->get('email');
        $employee->phone = $request->get('phone');
        $employee->address = $request->get('address');

        $employee->save();

        $request->session()->flash('status', 'Employee Updated!');

        return redirect('/employees/'.$employee->id);
    }
}

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

    public function index()
    {
        $employees = Employee::where('business_id',Auth::user()->business_id)->get();
        return view('employee.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $services = Service::whereDoesntHave('employees', function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        })->where('business_id',$employee->business_id)->get();
        return view('employee.show', compact('employee', 'services'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|alpha|min:1|max:60',
            'last_name' => 'required|alpha|min:1|max:60',
            'email' => 'required|email|unique:employees,email',
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

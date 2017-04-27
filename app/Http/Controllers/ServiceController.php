<?php

namespace App\Http\Controllers;

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
        $this->middleware(['role','auth']);
    }


    public function index()
    {
        $services = Service::where('business_id',Auth::user()->id)->get();
        return view('service.index',compact('services'));
    }

    public function create(){
        return view('service.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'business_id' => 'required|digits',
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|digits'
        ]);

        Service::create([
            'business_id' => $request->user()->business_id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'duration' => $request->get('duration')
        ]);
    }

    public function update(){

    }

    public function show(){}


    public function destroy(Service $service){
        if($service === null){
            session()->flash('error','There was a problem removing the service');
        }else {
            $service->delete();
            session()->flash('status', 'Service Removed');
        }
        return redirect('/services');
    }
}

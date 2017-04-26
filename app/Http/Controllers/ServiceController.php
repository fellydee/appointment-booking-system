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

    public function store(){

    }

    public function update(){

    }

    public function show(){}


    public function destroy($id){
        $service = Service::where('id',$id)->first();
        if($service === null){
            session()->flash('error','There was a problem removing the service');
        }else {
            Service::where('id', $id)->delete();
            session()->flash('status', 'Service Removed');
        }
        return redirect('/services');
    }
}

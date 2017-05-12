<?php

namespace App\Http\Controllers;

use App\Business;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    /**
     * Returns the business dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $business = Auth::user()->business;
        return view('business.index', compact('business'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'main_title' => 'required|max:50',
            'main_text' => 'required|max:200',
        ]);
    }

    function storeImage($file, $destination, $filename)
    {
        $ext = $file->extension();
        $fullpath = $destination . $filename . '.' . $ext;
        $file->move( base_path() . '/public/' . $destination, $filename . '.' . $ext);
        return $fullpath;
    }

    public function store(Request $request)
    {
        $business = Auth::user()->business;

        $business->main_title = $request->get('main_title');
        $business->main_text = $request->get('main_text');

        $destination = '/img/upload/' . $business->id . '/';
        if ($request->file('image')) {
            $path = $this->storeImage($request->file('image'), $destination, 'bg_img');
            $business->bg_img = $path;
        }

        if ($request->file('logo')) {
            $path = $this->storeImage($request->file('logo'), $destination, 'logo_img');
            $business->logo_img = $path;
        }
        $business->save();
        session()->flash('status', 'Business Settings Updated');
        return redirect('/business');
    }


}

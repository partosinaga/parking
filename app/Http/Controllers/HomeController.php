<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rate = Rate::select('rate')->first();
        $role = User::select('role')->where('id', \Auth::user()->id)->first();
        if ($role->role == 'user') {
            return view('parking.parking', compact('rate'));
        } else {
            return view('home', compact('rate'));
        }
    }
}

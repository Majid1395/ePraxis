<?php

namespace App\Http\Controllers;

use App\Buchung;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        if(Auth::user()->rolle->name == 'patient'){
            // to show doctors
            $aerzte_zeigen = User::where('rolle_id','=',1)->get();
            return view('home2',compact('aerzte_zeigen'));
        }
        // view patient
        $patienten = User::where('rolle_id','=',4)->get();

         // view booking
         $buchungen = Buchung::latest()
            ->where('datum','>=',date('Y-m-d'))
            ->paginate(20);

            return view('dashboard', compact('buchungen','patienten'));

    }
}

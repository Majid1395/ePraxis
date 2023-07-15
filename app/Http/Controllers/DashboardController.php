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
            // Ärzten zeigen
            $aerzte_zeigen = User::where('rolle_id','=',1)->get();
            return view('home2',compact('aerzte_zeigen'));
        }
        // Patienten ansehen
        $patienten = User::where('rolle_id','=',4)->get();

         // Buchung ansehen
         $buchungen = Buchung::latest()
            ->where('datum','>=',date('Y-m-d'))
            ->get();

            return view('dashboard', compact('buchungen','patienten'));

    }
}

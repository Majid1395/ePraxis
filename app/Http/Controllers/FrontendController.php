<?php

namespace App\Http\Controllers;


use App\Termin;
use App\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        if(request('datum')){
            $datum = request('datum');
            $aerzte = $this->aerzteFinden(request('datum'));
            return view('pages.frontend.aerzte',compact('aerzte', 'datum'));
        }
        // to show doctors which has appointment today
        $aerzte = Termin::where('datum',date('Y-m-d'))->get();
        // to show doctors
        $aerzte_zeigen = User::where('rolle_id','=',1)->get();

        return view('home2',compact('aerzte','aerzte_zeigen'));
    }

    public function aerzteFinden($datum){
        $aerzte = Termin::where('datum',$datum)->get();
        return $aerzte;
    }
}

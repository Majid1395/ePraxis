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
            $aerzte = Termin::where('datum',$datum)->get();
            return view('pages.frontend.aerzte',compact('aerzte', 'datum'));
        }
        // um den Ärzten zu zeigen, wer heute einen Termin hat
        $aerzte = Termin::where('datum',date('Y-m-d'))->get();
        // Ärzten zeigen
        $aerzte_zeigen = User::where('rolle_id','=',1)->get();

        return view('home2',compact('aerzte','aerzte_zeigen'));
    }

}

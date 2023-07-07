<?php

namespace App\Http\Controllers;


use App\Buchung;
use App\Mail\BuchungMail;
use App\Mail\BuchungMailBestaetigen;
use App\Mail\BuchungMailLoeschen;
use App\Termin;
use App\User;
use App\Zeit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;




class BuchungController extends Controller
{
    public function index(){
        $buchungCheck= Buchung::exists();

        if(!$buchungCheck){
            $buchungen = Buchung::get();
            return view('pages.buchung.index',compact('buchungen'));
        }

        $buchungen = Buchung::first()
            ->where('datum','>=',date('Y-m-d'))
            ->where('benutzer_id',auth()->user()->id)
            ->get();

        $zeiten = [];

        if($buchungen->count() > 0){
            foreach($buchungen as $buchung){
                $zeiten[$buchung->id] = Zeit::where('termin_id', $buchung->termin_id)
                    ->where('zeit', $buchung->zeit)
                    ->get()
                    ->toArray();
            }
            return view('pages.buchung.index',compact('buchungen','zeiten'));
        }
        else{
            return view('pages.buchung.index',compact('buchungen'));
        }
    }

    public function store(Request $request){
        $request->validate(['zeit'=>'required']);
        $mitarbeiterCheck = User::where('id',auth()->user()->id)
            ->where('rolle_id','=',3)
            ->exists();

        if($mitarbeiterCheck){
            $patient = $request->patientId;
            $check = $this->buchungCheckZeit($patient);
            if($check){
                $datum = $request->datum;
                $arztId = $request->arztId;
                return redirect()->route('neuer.termin',[$arztId,$datum])->with('errmessage','Dieser Patient hat bereits einen Termin vereinbart!.
                Bitte vereinbaren Sie einen anderen Termin.');
            }
        }else{
            $check = $this->buchungCheckZeitInterval();
            if($check){
                return redirect()->back()->with('errmessage','Sie haben bereits einen Termin vereinbart!
                Bitte warten Sie mit der nächsten Terminvereinbarung.');
            }
        }

        if($mitarbeiterCheck){
            Buchung::create([
                'benutzer_id'=> $request->patientId,
                'arzt_id'=> $request->arztId,
                'termin_id'=>$request->terminId,
                'zeit'=>$request->zeit,
                'datum'=>$request->datum,
                'status'=>0
            ]);
        }else{
            Buchung::create([
                'benutzer_id'=> auth()->user()->id,
                'arzt_id'=> $request->arztId,
                'termin_id'=>$request->terminId,
                'zeit'=>$request->zeit,
                'datum'=>$request->datum,
                'status'=>0
            ]);
        }

        Zeit::where('termin_id',$request->terminId)
            ->where('zeit',$request->zeit)
            ->update(['status'=>1]);

        //Send email notification
        $arztName = User::where('id', $request->arztId)->first();
        if($mitarbeiterCheck){
            $mailDaten = [
                'name'=>$request->patientId,
                'zeit'=>$request->zeit,
                'datum'=>$request->datum,
                'arztName'=> $arztName->name
            ];
        }else{
            $mailDaten = [
                'name'=>auth()->user()->name,
                'zeit'=>$request->zeit,
                'datum'=>$request->datum,
                'arztName'=> $arztName->name
            ];
        }
        //Mail::to(auth()->user()->email)->send(new BuchungMail($mailDaten));

        //dd("Email is sent successfully.");
        if($mitarbeiterCheck){
            $datum = $request->datum;
            $arztId = $request->arztId;
            return redirect()->route('neuer.termin',[$arztId,$datum])->with('message','Der Termin erfolgreich gebucht');
        }
        return redirect()->back()->with('message','Ihr Termin erfolgreich gebucht');
    }

    public function show($arztId,$datum){
        $termin = Termin::where('benutzer_id',$arztId)
            ->where('datum',$datum)
            ->first();
        $zeiten = Zeit::where('termin_id',$termin->id)
            ->where('status',0)
            ->get();
        $benutzer = User::where('id',$arztId)
            ->first();
        $arzt_id = $arztId;

        return view('pages.frontend.termin',compact('zeiten','datum','benutzer','arzt_id'));
    }

    public function patientId(Request $request){
        $request->validate(['id'=>'required']);
        $termin = Termin::where('benutzer_id',$request->arztId)
            ->where('datum',$request->datum)
            ->first();
        $zeiten = Zeit::where('termin_id',$termin->id)
            ->where('status',0)
            ->get();
        $benutzer = User::where('id',$request->arztId)
            ->first();
        $arzt_id = $request->arztId;
        $datum = $request->datum;
        $patientId = $request->id;
        return view('pages.frontend.termin',compact('zeiten','datum','benutzer','arzt_id','patientId'));
    }

    public function buchungCheckZeitInterval(){
        return Buchung::orderby('id', 'desc')
            ->where('benutzer_id', auth()->user()->id)
            ->whereDate('created_at', date('y-m-d'))
            ->exists();
    }

    public function buchungCheckZeit($patient){
        return Buchung::orderby('id', 'desc')
            ->where('benutzer_id', $patient)
            ->whereDate('created_at', date('y-m-d'))
            ->exists();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $buchung = Buchung::find($request->buchungId);
        $zeit = Zeit::find($request->zeitId);
        // dd($zeit->id, $zeit->status);
        $zeitStatus = $zeit->update(['status'=>0]);
        $buchungLoeschen = $buchung->delete();

        //Send email notification
        $patient = User::where('id', $buchung->benutzer_id)->first();
        $arzt = User::where('id', $buchung->arzt_id)->first();

        $mailDaten = [
            'name'=>$patient->name,
            'zeit'=>$buchung->zeit,
            'datum'=>$buchung->datum,
            'arztName'=> $arzt->name
        ];

        //Mail::to($patient->email)->send(new BuchungMailLoeschen($mailDaten));

        //dd("Email is sent successfully.");
        if(auth()->user()->role_id == 4){
            return redirect()->route('meine.buchung')->with('message','Buchung erfolgreich gelöscht!');
        }else if(auth()->user()->role_id == 1){
            return redirect()->route('alle.patienten')->with('message','Buchung erfolgreich gelöscht!');
        }else{
            return redirect()->route('alle.termine')->with('message','Buchung erfolgreich gelöscht!');
        }
    }


    /**   Arzt & Employee section    **/
    public function patientList(Request $request){
        $arzt = $this->arztId();

        // to show buchung for request datum
        if($request->datum){
            $buchungen = Buchung::latest()
                ->where('datum',$request->datum)
                ->where('arzt_id',$arzt)
                ->get();
        }else{
            // to show buchung for today
            $buchungen = Buchung::latest()
                ->where('datum',date('Y-m-d'))
                ->where('arzt_id',$arzt)
                ->get();
        }

        $zeiten = [];
        if(count($buchungen) > 0){
            foreach($buchungen as $buchung){
                $zeiten[$buchung->id] = Zeit::where('termin_id', $buchung->termin_id)
                    ->where('zeit', $buchung->zeit)
                    ->get()
                    ->toArray();
                $datum = $buchung->datum;
            }
            //dd($zeiten);
            return view('pages.patient_termine.index', compact('buchungen','zeiten','datum'));
        }else{
            return view('pages.patient_termine.index', compact('buchungen'));
        }
    }

    public function status($id){
        $buchung = Buchung::find($id);
        $buchung->status =! $buchung->status;
        $buchung->save();
        //Send email notification
        $patient = User::where('id', $buchung->benutzer_id)->first();
        $arzt = User::where('id', $buchung->arzt_id)->first();

        $mailDaten = [
            'name'=>$patient->name,
            'zeit'=>$buchung->zeit,
            'datum'=>$buchung->datum,
            'arztName'=> $arzt->name
        ];

        //Mail::to($patient->email)->send(new BuchungMailBestaetigen($mailDaten));
        return redirect()->back();
    }

    public function allePatienten(){
        $buchungen = Buchung::latest()
            ->where('datum','>=',date('Y-m-d'))
            ->paginate(20);

        $zeiten = [];
        $patient = [];
        if($buchungen->count() > 0){
            foreach($buchungen as $buchung){
                $zeiten[$buchung->id] = Zeit::where('termin_id', $buchung->termin_id)
                    ->where('zeit', $buchung->zeit)
                    ->get()
                    ->toArray();
                $patient[$buchung->benutzer_id]= User::where('id',$buchung->benutzer_id)
                    ->get()
                    ->toArray();
            }

        //dd($patient );
            return view('pages.patient_termine.alle', compact('buchungen','patient','zeiten'));
        }else{
            return view('pages.patient_termine.alle', compact('buchungen'));
        }
    }

    public function arztId(){
        $arztId = User::where('id',auth()->user()->id)->pluck('id');
        foreach($arztId as $id){
            return $id;
        }
    }
}

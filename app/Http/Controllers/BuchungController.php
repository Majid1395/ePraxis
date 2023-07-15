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
    /**
     * Display a listing of the resource.
     */
    public function index(){
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate(['zeit'=>'required']);
        // Mitarbeiter bestimmen
        $mitarbeiterCheck = User::where('id',auth()->user()->id)
            ->where('rolle_id','=',3)
            ->exists();

        if($mitarbeiterCheck){
            $patient = $request->patientId;
            $check = $this->buchungCheckZeitintervalMitPatient($patient);
            if($check){
                $datum = $request->datum;
                $arztId = $request->arztId;
                return redirect()->route('neuer.termin',[$arztId,$datum])->with('errmessage','Dieser Patient hat bereits einen Termin vereinbart!.');
            }
        }else{
            $check = $this->buchungCheckZeitinterval();
            if($check){
                return redirect()->back()->with('errmessage','Sie haben bereits einen Termin vereinbart!.');
            }
        }

        if($mitarbeiterCheck){
            $benutzerId = $request->patientId;
        }else{
            $benutzerId = auth()->user()->id;
        }
        // Buchung erstellen
        Buchung::create([
            'benutzer_id'=> $benutzerId ,
            'arzt_id'=> $request->arztId,
            'termin_id'=>$request->terminId,
            'zeit'=>$request->zeit,
            'datum'=>$request->datum,
            'status'=>0
        ]);
        // Status aktualisieren
        Zeit::where('termin_id',$request->terminId)
            ->where('zeit',$request->zeit)
            ->update(['status'=>1]);

        // E-Mail-Benachrichtigung senden
        //$this->buchungMail($request, $mitarbeiterCheck);

        if($mitarbeiterCheck){
            $datum = $request->datum;
            $arztId = $request->arztId;
            return redirect()->route('neuer.termin',[$arztId,$datum])->with('message','Der Termin erfolgreich gebucht');
        }
        return redirect()->back()->with('message','Ihr Termin erfolgreich gebucht');
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $buchung = Buchung::find($request->buchungId);
        $zeit = Zeit::find($request->zeitId);
        // den Termin wieder für andere Patienten freizugeben
        $zeitStatus = $zeit->update(['status'=>0]);
        $buchungLoeschen = $buchung->delete();

        // E-Mail-Benachrichtigung senden
        //$this->buchungLoeschenMail($buchung);

        // Als Patient
        if(auth()->user()->role_id == 4){
            return redirect()->route('meine.buchung')->with('message','Buchung erfolgreich gelöscht!');
        }// Als Arzt
        else if(auth()->user()->role_id == 1){
            return redirect()->route('alle.patienten')->with('message','Buchung erfolgreich gelöscht!');
        }// Als Mitarbeiter
        else{
            return redirect()->route('alle.termine')->with('message','Buchung erfolgreich gelöscht!');
        }
    }

    /*************************         Mitarbeiter        ****************************/
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

    /*************************         Arzt         *******************************/
    public function patientList(Request $request){
        $arzt = $this->arztId();

        // Buchung zum Anfragedatum anzeigen
        if($request->datum){
            $buchungen = Buchung::latest()
                ->where('datum',$request->datum)
                ->where('arzt_id',$arzt)
                ->get();
        }else{
            // Buchung für heute anzeigen
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

            return view('pages.patient_termine.index', compact('buchungen','zeiten','datum'));
        }else{
            return view('pages.patient_termine.index', compact('buchungen'));
        }
    }

    /**************************       Arzt & Mitarbeiter      ***************************/
    public function status($id){
        $buchung = Buchung::find($id);
        $buchung->status =! $buchung->status;
        $buchung->save();

        //E-Mail-Benachrichtigung senden
        //$this->bestaetigungsMail($buchung);

        return redirect()->back();
    }

    public function allePatienten(){
        $buchungen = Buchung::latest()
            ->where('datum','>=',date('Y-m-d'))
            ->get();

        $zeiten = [];

        if($buchungen->count() > 0){
            foreach($buchungen as $buchung){
                $zeiten[$buchung->id] = Zeit::where('termin_id', $buchung->termin_id)
                    ->where('zeit', $buchung->zeit)
                    ->get()
                    ->toArray();
            }

            return view('pages.patient_termine.alle', compact('buchungen','zeiten'));
        }else{
            return view('pages.patient_termine.alle', compact('buchungen'));
        }
    }

    /****************************       Hilfsfunktionen      **************************************/

    //Prüfen, ob der angemeldete Patient am aktuellen Tag bereits gebucht hat.
    public function buchungCheckZeitinterval(){
        return Buchung::orderby('id', 'desc')
            ->where('benutzer_id', auth()->user()->id)
            ->whereDate('datum', date('y-m-d'))
            ->exists();
    }

    //Prüfen, ob der gegebene Patient am aktuellen Tag bereits gebucht hat.
    public function buchungCheckZeitintervalMitPatient($patient){
        return Buchung::orderby('id', 'desc')
            ->where('benutzer_id', $patient)
            ->whereDate('datum', date('y-m-d'))
            ->exists();
    }

    // ID des angemeldeten Arztes
    public function arztId(){
        $arztId = User::where('id',auth()->user()->id)->pluck('id');
        foreach($arztId as $id){
            return $id;
        }
    }

    //E-Mail-Benachrichtigung senden
    public function buchungMail($request, $mitarbeiterCheck){
        $arztName = User::where('id', $request->arztId)
            ->first();

        if($mitarbeiterCheck){
            $name = $request->patientId;
        }else{
            $name = auth()->user()->name;
        }
        $mailDaten = [
            'name'=>$name,
            'zeit'=>$request->zeit,
            'datum'=>$request->datum,
            'arztName'=> $arztName->name
        ];

        return Mail::to(auth()->user()->email)->send(new BuchungMail($mailDaten));
    }

    //E-Mail-Benachrichtigung senden
    public function buchungLoeschenMail($buchung){
        $patient = User::where('id', $buchung->benutzer_id)->first();
        $arzt = User::where('id', $buchung->arzt_id)->first();

        $mailDaten = [
            'name'=>$patient->name,
            'zeit'=>$buchung->zeit,
            'datum'=>$buchung->datum,
            'arztName'=> $arzt->name
        ];

        return Mail::to($patient->email)->send(new BuchungMailLoeschen($mailDaten));
    }

    //E-Mail-Benachrichtigung senden
    public function bestaetigungsMail($buchung){
        $patient = User::where('id', $buchung->benutzer_id)->first();
        $arzt = User::where('id', $buchung->arzt_id)->first();

        $mailDaten = [
            'name'=>$patient->name,
            'zeit'=>$buchung->zeit,
            'datum'=>$buchung->datum,
            'arztName'=> $arzt->name
        ];

        return Mail::to($patient->email)->send(new BuchungMailBestaetigen($mailDaten));
    }
}

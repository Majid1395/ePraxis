<?php

namespace App\Http\Controllers;



use App\Buchung;
use App\Termin;
use App\Zeit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meineTermine = Termin::where('benutzer_id',auth()->user()->id)
            ->exists();
        if($meineTermine){
            $meineTermine = Termin::first()
                ->where('datum','>=',date('Y-m-d'))
                ->where('benutzer_id',auth()->user()->id)
                ->get();
                return view('pages.termin.index',compact('meineTermine'));
        }else{
            return view('pages.termin.index',compact('meineTermine'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.termin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Dieselbe ID darf nicht am selben Tag ausgewählt werden
        $this->validate($request,[
            'datum'=>'required|unique:termins,datum,NULL,id,benutzer_id,'.Auth::id(),
            'zeit'=>'required'
        ]);
        $termin = Termin::create([
            'benutzer_id'=>auth()->user()->id,
            'datum'=> $request->datum
        ]);
        foreach($request->zeit as $zeit){
            Zeit::create([
                'termin_id'=>$termin->id,
                'zeit'=> $zeit,
                'status'=>0
            ]);
        }
        return redirect()->back()->with('message','Termin erfolgreich vereinbart am '.$request->datum);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($datum)
    {
        $termin = Termin::where('datum',$datum)
            ->where('benutzer_id',auth()->user()->id)
            ->first();
        $terminId = $termin->id;
        $zeiten = Zeit::where('termin_id',$terminId)
            ->get();
        return view('pages.termin.edit', compact('zeiten','terminId','datum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $terminId = $request->terminId;
        $zeiten = $request->zeit;
        $termin = Zeit::where('termin_id',$terminId)
            ->where('status','=', 0)
            ->delete();
        foreach($zeiten as $zeit){
            Zeit::create([
                'termin_id'=>$terminId,
                'zeit'=>$zeit,
                'status'=>0
            ]);
        }
        return redirect()->route('termin.index')->with('message','Termin erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $termin = Termin::find($id);
        $terminId = $termin->id;
        $check= $this->BuchungZeiten($terminId);

        if(($check)){
            return redirect()->to('/termin')->with('errmessage','Terminvereinbarung nicht löschbar');
        }
        $terminDelete = $termin->delete();
        $zeitDelete = Zeit::where('termin_id',$terminId)->delete();
        return redirect()->route('termin.index')->with('message','Termin erfolgreich gelöscht!');
    }

    public function BuchungZeiten($terminId){
        return Zeit::where('termin_id',$terminId)
            ->where('status',1)
            ->exists();
    }
}

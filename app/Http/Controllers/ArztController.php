<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class ArztController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // nur Mitarbeiter zeigen
        $benutzer = User::where('rolle_id','=',3)->get();
        return view('pages.arzt.index',compact('benutzer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.arzt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $daten = $request->all();
        $bild = $this->benutzerBild($request);
        $daten['bild'] = $bild;
        $daten['password'] = bcrypt($request->password);
        // alle Daten hinzufügen
        User::create($daten);
        //Weiterleitung zur 'arzt.index'-Route mit Erfolgsmeldung
        return redirect()->back()->with('message','Mitarbeiter erfolgreich hinzugefügt!');
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
    public function edit(string $id)
    {
        $benutzer = User::find($id);
        return view('pages.arzt.edit', compact('benutzer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateUpdate($request,$id);
        $daten = $request->all();
        $benutzer = User::find($id);
        $bild = $benutzer->bild;
        $benutzerPassword = $benutzer->password;
        if($request->hasFile('bild')){
            $bild = $this->benutzerBild($request);
            // to remove old Photo
            unlink(public_path('assets/images/users/'.$benutzer->bild));
        }
        $daten['bild'] = $bild;
        //Neues Passwort mit Kryptographie aktualisieren
        if($request->password){
            $daten['password'] = bcrypt($request->password);
        }else{
            $daten['password'] = $benutzerPassword;
        }
        $benutzer->update($daten);
        //Weiterleitung zur 'arzt.index'-Route mit Erfolgsmeldung
        return redirect()->route('arzt.index')->with('message','Mitarbeiter erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // mich selbst nicht zu löschen
        if(auth()->user()->id == $id){
            return view('pages.error.404');
        }

        $benutzer = User::find($id);
        $benutzerDelete = $benutzer->delete();
        if($benutzerDelete){
            unlink(public_path('assets/images/users/'.$benutzer->bild));
        }
        return redirect()->route('arzt.index')->with('message','Mitarbeiter erfolgreich gelöscht');
    }

    /********************* Hilfsfunktionen *************************/
    public function validateStore($request){
        return  $this->validate($request,[
            'name'=>'required',
            'vorname'=>'required',
            'strasse'=>'required',
            'stadt'=>'required',
            'plz'=>'required|numeric',
            'email'=>'required|unique:users',
            'password'=>'required|min:6|max:25',
            'geschlecht'=>'required',
            'bildungsgrad'=>'required',
            'bild'=>'required|mimes:jpeg,jpg,png',
       ]);
    }

    public function validateUpdate($request, $id){
        return  $this->validate($request,[
            'vorname'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'geschlecht'=>'required',
            'bildungsgrad'=>'required',
            'strasse'=>'required',
            'stadt'=>'required',
            'plz'=>'required|numeric',
            'bild'=>'mimes:jpeg,jpg,png',
       ]);
    }

    public function defaultBild(){
        $destination = public_path('/assets/images/users');
        $defaultName = 'default.png';

        // Überprüfe, ob das Ersatzfoto bereits existiert, um eine Duplikation zu vermeiden
        if (!file_exists($destination.'/'.$defaultName)) {
            // Kopiere das Ersatzfoto aus dem Standardverzeichnis
            copy(public_path('/assets/images/default.png'), $destination.'/'.$defaultName);
        }

        // Generiere einen eindeutigen Namen für das Ersatzfoto
        $uniqueName = uniqid().'.'.$defaultName;
        rename($destination.'/'.$defaultName, $destination.'/'.$uniqueName);

        return $uniqueName;
    }

    public function benutzerBild($request){
        $bild = $request->file('bild');
        $name = $bild->hashName();
        $destination = public_path('/assets/images/users');
        $bild->move($destination,$name);
        return $name;
    }
}

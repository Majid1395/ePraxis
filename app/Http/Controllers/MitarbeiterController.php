<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MitarbeiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Patienten ansehen
        $benutzer = User::where('rolle_id','=',4)->get();

        return view('pages.mitarbeiter.index',compact('benutzer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mitarbeiter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'vorname'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6|max:25',
            'geschlecht'=>'required',
        ]);

        $daten = $request->all();

        $bild = $this->defaultBild();
        $daten['bild'] = $bild;

        $daten['password'] = bcrypt($request->password);
        User::create($daten);

        return redirect()->back()->with('message','Patient erfolgreich hinzugefügt');
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
        return view('pages.mitarbeiter.edit', compact('benutzer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validate($request,[
             'name'=>'required',
             'vorname'=>'required',
             'email'=>'required|unique:users,email,'.$id,
             'geschlecht'=>'required',
        ]);

        $daten = $request->all();
        $benutzer = User::find($id);
        $benutzerPassword = $benutzer->password;
        if($request->password){
            $daten['password'] = bcrypt($request->password);
        }else{
            $daten['password'] = $benutzerPassword;
        }
        $benutzer->update($daten);
        return redirect()->route('mitarbeiter.index')->with('message','Patient erfolgreich aktualisiert');
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

        return redirect()->route('mitarbeiter.index')->with('message','Patient erfolgreich gelöscht');
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
}

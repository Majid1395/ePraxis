<?php

namespace App\Http\Controllers;


use App\Rolle;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Administrator, Arzt ohne Patient und Mitarbeiter anzeigen
        $benutzer = User::where('rolle_id','!=',4)->where('rolle_id','!=',3)->get();

        return view('pages.admin.index',compact('benutzer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminCreate()
    {
        return view('pages.admin.admin_create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function arztCreate()
    {
        return view('pages.admin.arzt_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_store(Request $request)
    {
        $rolleId = $request->rolle_id;
        $this->validateStore($request, $rolleId);
        $daten = $request->all();
        if($request->file('bild')){
            $bild = $this->benutzerBild($request);
            $daten['bild'] = $bild;
        }else{
            $bild = $this->defaultBild();
            $daten['bild'] = $bild;
        }
        $daten['password'] = bcrypt($request->password);
        User::create($daten);

        return redirect()->route('admin.index')->with('message','Admin erfolgreich hinzugefügt!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function arzt_store(Request $request)
    {
        $rolleId = $request->rolle_id;
        $this->validateStore($request, $rolleId);
        $daten = $request->all();
        if($request->file('bild')){
            $bild = $this->benutzerBild($request);
            $daten['bild'] = $bild;
        }else{
            $bild = $this->defaultBild();
            $daten['bild'] = $bild;
        }
        $daten['password'] = bcrypt($request->password);
        User::create($daten);

        return redirect()->route('admin.index')->with('message','Arzt erfolgreich hinzugefügt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benutzer = User::find($id);
        return view('pages.admin.edit', compact('benutzer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rolleId = $request->rolle_id;
        $this->validateUpdate($request,$id,$rolleId);
        $daten = $request->all();
        $benutzer = User::find($id);
        $bild = $benutzer->bild;
        $benutzerPassword = $benutzer->password;
        if($request->hasFile('bild')){
            $bild = $this->benutzerBild($request);
            // altes Bild zu löschen
            unlink(public_path('assets/images/users/'.$benutzer->bild));
        }
        $daten['bild'] = $bild;
        if($request->password){
            $daten['password'] = bcrypt($request->password);
        }else{
            $daten['password'] = $benutzerPassword;
        }
        $benutzer->update($daten);
        return redirect()->route('admin.index')->with('message','Benutzer erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // mich selbst nicht zu löschen(admin)
        if(auth()->user()->id == $id){
            return view('pages.error.404');
        }

        $benutzer = User::find($id);
        $benutzerLöschen = $benutzer->delete();
        // altes Bild zu löschen
        if($benutzerLöschen){
            unlink(public_path('assets/images/users/'.$benutzer->bild));
        }
        return redirect()->route('admin.index')->with('message','Benutzer erfolgreich gelöscht!');
    }

    /********************* Hilfsfunktionen *************************/
    public function validateStore($request, $rolleId){
        if($rolleId == 1){
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
                'fachbereich'=>'required',
                'bild'=>'required|mimes:jpeg,jpg,png'

           ]);
        }
        else{
            return  $this->validate($request,[
                'name'=>'required',
                'vorname'=>'required',
                'email'=>'required|unique:users',
                'password'=>'required|min:6|max:25',
                'geschlecht'=>'required'
           ]);
        }
    }

    public function validateUpdate($request, $id, $rolleId){
        if($rolleId == 1){
            return  $this->validate($request,[
                'name'=>'required',
                'vorname'=>'required',
                'email'=>'required|unique:users,email,'.$id,
                'strasse'=>'required',
                'stadt'=>'required',
                'plz'=>'required|numeric',
                'geschlecht'=>'required',
                'bildungsgrad'=>'required',
                'fachbereich'=>'required',
                'bild'=>'mimes:jpeg,jpg,png',
                'rolle_id'=>'required',
           ]);
        }
        else{
            return  $this->validate($request,[
                'vorname'=>'required',
                'name'=>'required',
                'email'=>'required|unique:users,email,'.$id,
                'geschlecht'=>'required',
                'rolle_id'=>'required'
           ]);
        }
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

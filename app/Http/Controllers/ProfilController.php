<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.profil.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'vorname'=>'required',
            'name'=>'required',
            'email'=>'required',
            'geschlecht'=>'required'
        ]);
        $benutzer = User::find(auth()->user()->id);
        $daten = $request->all();
        $benutzerPassword = $benutzer->password;
        if($request->password){
            $daten['password'] = bcrypt($request->password);
        }else{
            $daten['password'] = $benutzerPassword;
        }
        $benutzer->update($daten);
        return redirect()->back()->with('message','Profil erfolgreich aktualisiert!');

        //OR
        // User::where('id',auth()->user()->id)->update($request->except('_token'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function profilBild(Request $request){
        $this->validate($request,['file'=>'required|image|mimes:jpeg,jpg,png']);

        if($request->hasFile('file')){
            $bild = $request->file('file');
            $name = time().'.'.$bild->getClientOriginalExtension();
            $destination = public_path('/assets/images/users');
            $bild->move($destination,$name);

            $benutzerBild = User::where('id',auth()->user()->id)->update([
                'bild'=>$name
            ]);

            return redirect()->back()->with('message1','Profilbild erfolgreich aktualisiert!');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Bildungsgrad;
use App\User;
use Illuminate\Http\Request;

class BildungsgradController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bildungsgrads = Bildungsgrad::get();
        return view('pages.bildungsgrad.index',compact('bildungsgrads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bildungsgrad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:bildungsgrads'
        ]);
        $daten = $request->all();

        Bildungsgrad::create($daten);

        return redirect()->back()->with('message','Bildungsgrad erfolgreich erstellt');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bildungsgrad = Bildungsgrad::find($id);
        return view('pages.bildungsgrad.edit', compact('bildungsgrad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:bildungsgrads,name,'.$id
        ]);
        $daten = $request->all();
        $bildungsgrad = Bildungsgrad::find($id);
        //zu überprüfen, ob dieser Bildungsgrad von den Nutzern in Anspruch genommen wird
        $benutzer = User::where('bildungsgrad',$bildungsgrad->name)->exists();
        if($benutzer){
            return redirect()->route('bildungsgrad.index')->with('errmessage','Bildungsgrad ist nicht aktualisierbar');
        }
        $bildungsgrad->update($daten);

        return redirect()->route('bildungsgrad.index')->with('message','Bildungsgrad erfolgreich aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bildungsgrad = Bildungsgrad::find($id);
        //Sicherstellung, dass mindestens ein Bildungsgrad in der Datenbank vorhanden ist
        $check = Bildungsgrad::count();
        if($check == 1){
            return redirect()->route('bildungsgrad.index')->with('errmessage','Bildungsgrad ist nicht löschbar');
        }

        //zu überprüfen, ob dieser Bildungsgrad von den Nutzern in Anspruch genommen wird
        $benutzer = User::where('bildungsgrad',$bildungsgrad->name)->exists();
        if($benutzer){
            return redirect()->route('bildungsgrad.index')->with('errmessage','Bildungsgrad ist nicht löschbar');
        }
        $bildungsgradLoeschen = $bildungsgrad->delete();

        return redirect()->route('bildungsgrad.index')->with('message','Bildungsgrad erfolgreich gelöscht');
    }
}

<?php

namespace App\Http\Controllers;

use App\Department;
use App\Fachbereich;
use App\User;
use Illuminate\Http\Request;

class FachbereichController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fachbereiche = Fachbereich::get();
        return view('pages.fachbereich.index',compact('fachbereiche'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.fachbereich.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:fachbereiches'
        ]);
        $daten = $request->all();

        Fachbereich::create($daten);

        return redirect()->back()->with('message','Fachbereich erfolgreich erstellt');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fachbereich = Fachbereich::find($id);
        return view('pages.fachbereich.edit', compact('fachbereich'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:fachbereiches,name,'.$id
        ]);
        $daten = $request->all();
        $fachbereich = Fachbereich::find($id);
        // zu überprüfen, ob dieser Fachbereich von den Nutzern in Anspruch genommen wird
        $benutzer = User::where('fachbereich',$fachbereich->name)->exists();
        if($benutzer){
            return redirect()->route('fachbereich.index')->with('errmessage','Fachbereich ist nicht aktualisierbar');
        }
        $fachbereich->update($daten);

        return redirect()->route('fachbereich.index')->with('message','Fachbereich erfolgreich aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fachbereich = Fachbereich::find($id);
        //Sicherstellung, dass mindestens ein Fachbereich in der Datenbank vorhanden ist
        $check = Fachbereich::count();
        if($check == 1){
            return redirect()->route('fachbereich.index')->with('errmessage','Fachbereich ist nicht löschbar');
        }
        //zu überprüfen, ob dieser Fachbereich von den Nutzern in Anspruch genommen wird
        $benutzer = User::where('fachbereich',$fachbereich->name)->exists();
        if($benutzer){
            return redirect()->route('fachbereich.index')->with('errmessage','Fachbereich ist nicht löschbar');
        }
        $fachbereichLoeschen = $fachbereich->delete();

        return redirect()->route('fachbereich.index')->with('message','Fachbereich erfolgreich gelöscht');
    }

}

<?php

use App\Bildungsgrad;
use App\Fachbereich;
use App\Rolle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /******************* Hinzufügen aller Rollen **********************/
        Rolle::create(['name'=>'arzt']);
        Rolle::create(['name'=>'admin']);
        Rolle::create(['name'=>'mitarbeiter']);
        Rolle::create(['name'=>'patient']);

        /******************* Hinzufügen Super Admin **********************/
        $bild = $this->defaultBild();
        $rolle = Rolle::where('name','admin')->first();

        DB::table('users')->insert([
            'vorname' => 'Super',
            'name' => 'Admin',
            'email' => 'epraxis@outlook.de',
            'password' => Hash::make('ep12344321'),
            'bild' => $bild,
            'rolle_id' => $rolle->id
        ]);

        /******************* Hinzufügen Fachbereich **********************/

        Fachbereich::create(['name'=>'Hausarzt']);
        Fachbereich::create(['name'=>'HNO']);

        /******************* Hinzufügen Bildungsgrad **********************/

        Bildungsgrad::create(['name'=>'Dr.med.']);
        Bildungsgrad::create(['name'=>'Dr.med.dent.']);
        Bildungsgrad::create(['name'=>'Dr.PH']);
        Bildungsgrad::create(['name'=>'Praxismanager']);
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

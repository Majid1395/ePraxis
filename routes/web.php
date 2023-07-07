<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*----------------------------- Allgemeine Routen -------------------------------------- */
Auth::routes();
Route::get('/','FrontendController@index');
Route::get('/home','HomeController@index')->name('home2');
Route::get('/dashboard','DashboardController@index')->name('dashboard');

/*----------------------------- Routen der Rolle (Admin) -------------------------------------- */
Route::group(['middleware'=>['auth','admin']],function(){
    // um Arzt und Administrator hinzuzufügen, zu löschen und zu aktualisieren
    Route::resource('admin','AdminController');
    Route::get('/admin','AdminController@index')->name('admin.index');
    Route::get('/admin/create','AdminController@adminCreate')->name('admin.create');
    Route::get('/admin/arzt/create','AdminController@arztCreate')->name('admin.arzt');
    Route::post('/admin/create','AdminController@admin_store')->name('admin.store');
    Route::post('/admin/arzt/create','AdminController@arzt_store')->name('admin.arzt_store');

    // um Fachbereich zu erstellen, zu löschen und zu aktualisieren
    Route::resource('fachbereich','FachbereichController');
    Route::get('/fachbereich','FachbereichController@index')->name('fachbereich.index');

    // um Bildungsgrad zu erstellen, zu löschen und zu aktualisieren
    Route::resource('bildungsgrad','BildungsgradController');
    Route::get('/bildungsgrad','BildungsgradController@index')->name('bildungsgrad.index');
});

/*----------------------------- Routen der Rolle (Arzt) -------------------------------------- */
Route::group(['middleware'=>['auth','arzt']],function(){
    // um Mitarbeiter hinzuzufügen, zu löschen und zu aktualisieren
    Route::resource('arzt','ArztController');
    Route::get('/arzt','ArztController@index')->name('arzt.index');

    // um einen Termin zu erstellen, zu löschen und zu aktualisieren
    Route::resource('termin','TerminController');
    Route::get('/termin','TerminController@index')->name('termin.index');
    Route::post('/termin/aktualisiere','TerminController@update')->name('termin.aktualisiere');

    // Patientenbuchungenliste des angemeldeten Arztes
    Route::get('/termine/patient','BuchungController@patientList')->name('termine.patient');

    // Liste aller Patientenbuchungen
    Route::get('/termine/arzt/alle-patienten','BuchungController@allePatienten')->name('alle.patienten');

    // Buchung Löschen für einen bestimmten Patient
    Route::post('/termin/arzt/patient/loeschen','BuchungController@destroy')->name('loeschen.buchung');

    // Bestätigung der Buchung für einen bestimmten Patienten durch Änderung des Status
    Route::get('/termine/status/aktualisiere/{id}','BuchungController@status')->name('aktualisiere.status');
});

/*----------------------------- Routen der Rolle (Mitarbeiter) -------------------------------------- */
Route::group(['middleware'=>['auth','mitarbeiter']],function(){
    // um Patienten hinzuzufügen, zu löschen und zu aktualisieren
    Route::resource('mitarbeiter','MitarbeiterController');

    // Liste aller Patientenbuchungen
    Route::get('/termine/alle-patienten','BuchungController@allePatienten')->name('alle.termine');

    // Buchung Löschen für einen bestimmten Patient
    Route::post('/termin/patient/loeschen','BuchungController@destroy')->name('buchung.loeschen');

    // Bestätigung der Buchung für einen bestimmten Patienten durch Änderung des Status
    Route::get('/status/aktualisiere/{id}','BuchungController@status')->name('status.aktualisiere');

    // um einen Termin für den Patienten zu buchen
    Route::post('/neuer-termin/patient','BuchungController@patientId')->name('patient.id');
    Route::get('/neuer-termin/{arztId}/{datum}','BuchungController@show')->name('neuer.termin');
    Route::post('/buchen/termin','BuchungController@store')->name('buchen.termin');
});

/*-----------------------------Routen der Rolle (Patient)-------------------------------------- */
Route::group(['middleware'=>['auth','patient']],function(){
    // Buchungsliste des angemeldeten Patients
    Route::get('/meine-buchung','BuchungController@index')->name('meine.buchung');
    Route::post('/meine-buchung/loeschen','BuchungController@destroy')->name('meine-buchung.loeschen');

    // um einen Termin zu buchen
    Route::get('/neuer-termin/patient/{arztId}/{datum}','BuchungController@show')->name('termin.neu');
    Route::post('/buchen/termin/patient','BuchungController@store')->name('termin.buchen');
});

/*----------------------------- Profilverwaltungsrouten -------------------------------------- */
Route::get('/benutzer-profil','ProfilController@index')->name('profil');
Route::post('/profil/update','ProfilController@update')->name('profil.update');
Route::post('/profil-bild','ProfilController@profilBild')->name('profil.bild');

/*-----------------------------sonstige-------------------------------------- */
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 für undefinierte Routen
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');


/*-------------------------------------------------------------------------- */



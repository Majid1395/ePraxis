<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rolle;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'vorname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'geschlecht'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        $rolle = Rolle::where('name','patient')->first();
        $bild = $this->defaultBild();

        return User::create([
            'vorname' => $data['vorname'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rolle_id'=>$rolle->id,
            'geschlecht'=>$data['geschlecht'],
            'bild'=>$bild
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
}

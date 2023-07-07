<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'vorname',
        'strasse',
        'stadt',
        'plz',
        'geschlecht',
        'email',
        'password',
        'rolle_id',
        'telefonnummer',
        'fachbereich',
        'bild',
        'bildungsgrad',
        'geburtsdatum',
        'beschreibung'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rolle(){
        return $this->hasOne('App\Rolle','id','rolle_id');
    }

    public function bildungsgrad()
    {
        return $this->belongsTo(Bildungsgrad::class, 'bildungsgrad', 'name');
    }

    public function fachbereich()
    {
        return $this->belongsTo(Fachbereich::class, 'fachbereich', 'name');
    }

}


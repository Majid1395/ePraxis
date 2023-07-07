<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function arzt(){
        //Modellklasse(Termin) ist Teil der Modellklasse(User)
        return $this->belongsTo(User::class,'benutzer_id','id');
    }

    public function zeiten(){
        //Modellklasse(Termin) kann mehrere Instanzen des (Zeit) Modells haben
        return $this->hasMany(Zeit::class, 'termin_id');
    }
}

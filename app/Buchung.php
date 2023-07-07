<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buchung extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function arzt(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(User::class, 'benutzer_id');
    }

    public function zeit(){
        return $this->belongsTo(Zeit::class, 'zeit', 'zeit');
    }

    public function termin(){
        return $this->belongsTo(Termin::class, 'termin_id', 'id');
    }

}

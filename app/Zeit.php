<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zeit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function termin(){
        return $this->belongsTo(Termin::class, 'termin_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devvn_xaphuongthitran extends Model
{
    protected $table = 'devvn_xaphuongthitran';
     protected $primaryKey = 'xaid';
    protected $fillable = [
        'xaid', 'name', 'type', 'maqh'
    ];
    public function Devvn_quanhuyen(){
        return $this->belongsTo('App\Models\Devvn_quanhuyen','maqh','xaid');
    }
}

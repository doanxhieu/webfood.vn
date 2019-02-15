<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devvn_quanhuyen extends Model
{
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    protected $fillable = [
        'maqh', 'name', 'type', 'matp'
    ];
    public function Devvn_tinhthanhpho(){
        return $this->belongsTo('App\Models\Devvn_tinhthanhpho','matp','maqh');
    }
    public function Devvn_xaphuongthitran(){
        return $this->hasMany('App\Models\Devvn_xaphuongthitran','maqh','maqh');
    }
}

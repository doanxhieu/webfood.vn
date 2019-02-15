<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devvn_tinhthanhpho extends Model
{
    protected $table ="devvn_tinhthanhpho";
    protected $primaryKey = 'matp';
    protected $fillable = [
        'matp', 'name', 'type'
    ];
    public function Devvn_quanhuyen(){
        return $this->hasMany('App\Models\Devvn_quanhuyen','matp','matp');
    }
}

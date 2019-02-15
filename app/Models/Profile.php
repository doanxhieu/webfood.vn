<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable =[
        'user_id',
        'facebook_id',
        'facebook_name',
        'address',
        'phone',
        'avatar',
        'description'
    ];
    public function users() {
        return $this->hasOne('App\Models\User','user_id');
    }
    
   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    /**
     * Returns the roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    protected $table='users';
    protected $fillable = [
        'email','password','permissions','first_name','last_name','address','phone'
    ];

    public $timestamps = false;
    public function products()
    {
        return $this->hasMany('App\Models\Product','user_id');
    }
    /**
     * Returns the roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile() {
        return $this->hasOne('App\Models\Profile','user_id');
    }
    public function bill(){
        return $this->hasMany('App\Models\Bill','customer_id');
    }

    public function store(){
        
    }
}

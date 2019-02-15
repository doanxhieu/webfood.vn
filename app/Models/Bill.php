<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = [
        'customer_id','address','phone','total_product','total_amount','status','payment'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User', 'customer_id');
    }
    public function bill_detail()
    {
        return $this->hasMany('App\Models\Bill_detail','bill_id');
    }
    
}

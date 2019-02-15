<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    protected $table = 'bill_details';
    protected $fillable = [
        'bill_id','product_id','quantity','amount'
    ];
    public function bill(){
        return $this->belongsTo('App\Models\Bill', 'bill_id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product','product_id','id');
    }
}

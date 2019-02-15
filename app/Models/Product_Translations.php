<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Translations extends Model
{
    protected $table='product_translations';
    protected $primaryKey='id';
     protected $softDelete = true;
    protected $fillable = [
        'product_id',
        'lang',
        'title',
        'brief',
        'description',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    
}

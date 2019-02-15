<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CategoryTranslation extends Model
{

    protected $table = 'category_translations';
    
    protected $fillable = [
        'category_id',
        'lang',
        'name'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;

class Category extends Model
{
    use Sluggable;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'slug',
        'parent_id',
        'created_at',
        'updated_at'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name.vi'
            ]
        ];
    }
    public function category_translation()
    {
        return $this->hasMany('App\Models\CategoryTranslation', 'category_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
    public function translation($language = null)
    {
        if ($language == null) {
            $language = app()->getLocale();
        }
        return $this->hasMany('App\Models\CategoryTranslation','category_id', 'id')->where('lang', '=', $language);
    }
    
    public function childs_cates() {
        return $this->hasMany('App\Models\Category','parent_id');
    }

}

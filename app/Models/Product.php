<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Product extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'products';
     protected $softDelete = true;
    protected $fillable = [
        'id',
        'slug',
        'category_id',
        'photo',
        'user_id',
        'price',
        'promotion_price',
        'quantity',
        'status',
        'rating',
    ];
    /**
     * Sluggable configuration.
     *
     * @var array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name.vi'
            ]
        ];
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function product_translations() {
        return $this->hasMany('App\Models\Product_Translations','product_id','id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function bill_detail()
    {
        return $this->belongsTo('App\Models\Bill_detail');
    }
    public function translation($language = null)
    {
        if ($language == null) {
            $language = app()->getLocale();
        }
        return $this->hasMany('App\Models\Product_Translations')->where('lang', '=', $language);
    }
    
}

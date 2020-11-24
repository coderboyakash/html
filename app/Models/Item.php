<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'product_brand_id', 'description', 'price', 'quantity', 'color_id', 'size_id', 'flavour_id', 'strength_id', 'image_id'];

    public function brand()
    {
        return $this->belongsTo('App\Models\ProductBrand', 'product_brand_id');
    }

    public function specifications()
    {
        return $this->hasMany('App\Models\ItemSpecification');
    }

    public function descriptions()
    {
        return $this->hasMany('App\Models\ItemDescription');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\ItemVariant');
    }

    public function featured_arrival()
    {
        return $this->belongsTo('App\Models\FeaturedArrival', 'id', 'item_id');
    }

    public function special_arrival()
    {
        return $this->belongsTo('App\Models\SpecialArrival', 'id', 'item_id');
    }

    public function top_selling_week()
    {
        return $this->belongsTo('App\Models\TopSellingWeek', 'id', 'item_id');
    }

    public function top_selling_month()
    {
        return $this->belongsTo('App\Models\TopSellingMonth', 'id', 'item_id');
    }

    public function image()
    {
        return $this->hasOne('App\Models\Image', 'id','image_id');
    }
}

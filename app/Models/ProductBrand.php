<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_type_id'];

    public function type()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id');
    }
    
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}

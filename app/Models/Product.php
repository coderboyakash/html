<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon_path'];
    use SoftDeletes;

    public function types()
    {
        return $this->hasMany('App\Models\ProductType', 'product_id');
    }
    public function only_product()
    {
        return $this->hasOne('App\Models\OnlyProduct', 'product_id');
    }
}

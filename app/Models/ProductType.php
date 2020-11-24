<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'product_id'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function brands()
    {
        return $this->hasMany('App\Models\ProductBrand');
    }

    public function sub_menu()
    {
        return $this->hasOne('App\Models\SubMenu');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['item_id', 'size_id', 'color_id', 'user_id', 'quantity', 'flavour_id', 'strength_id'];
    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}

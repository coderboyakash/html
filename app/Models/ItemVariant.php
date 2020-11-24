<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','item_id', 'price', 'quantity', 'sale'];
}

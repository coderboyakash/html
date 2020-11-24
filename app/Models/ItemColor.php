<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemColor extends Model
{
    protected $fillable = ['item_id', 'name', 'price', 'quantity'];
    use HasFactory;
    use SoftDeletes;
}

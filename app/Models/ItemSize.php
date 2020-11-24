<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSize extends Model
{
    protected $fillable = ['item_id', 'size', 'price', 'quantity'];
    use HasFactory;
    use SoftDeletes;
}

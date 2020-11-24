<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlyProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'is_exsits'];
}

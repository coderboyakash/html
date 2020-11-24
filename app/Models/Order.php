<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = ['invoice_id', 'user_id','name', 'quantity', 'price', 'delivery_status', 'delivery_mode_is'];
    use HasFactory;
    use SoftDeletes;
}

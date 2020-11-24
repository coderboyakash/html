<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    protected $fillable = ['payment_id', 'fname', 'lname', 'subtotal', 'state', 'method', 'payer_id', 'invoice_number', 'address', 'phone', 'provison', 'city'. 'country', 'zip_code'];
    use HasFactory;
    use SoftDeletes;
}

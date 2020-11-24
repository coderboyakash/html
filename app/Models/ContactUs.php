<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    protected $fillable = ['mail', 'fb_link', 'ins_link', 'tw_link','you_link', 'phone', 'address', 'lind_link', 'pin_link'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSetting extends Model
{
    protected $fillable = ['name', 'vat_no', 'reg_no', 'website_link'];
    use HasFactory;
    use SoftDeletes;
}

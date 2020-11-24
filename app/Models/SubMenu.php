<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['product_type_id', 'is_exsits'];
}

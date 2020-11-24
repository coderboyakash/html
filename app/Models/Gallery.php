<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['image_id'];

    public function image()
    {
        return $this->hasOne('App\Models\Image', 'id', 'image_id');
    }
}

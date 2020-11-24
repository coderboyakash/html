<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopSellingMonth extends Model
{
    use HasFactory;

    protected $fillable = ['item_id'];

    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}

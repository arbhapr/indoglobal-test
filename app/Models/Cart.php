<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    function buyer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

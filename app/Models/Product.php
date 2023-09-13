<?php

namespace App\Models;

use App\Models\MCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(MCategory::class, 'category_id');
    }
}

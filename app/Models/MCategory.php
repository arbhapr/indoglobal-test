<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function products() {
        return $this->hasMany(Product::class, "category_id");
    }
}

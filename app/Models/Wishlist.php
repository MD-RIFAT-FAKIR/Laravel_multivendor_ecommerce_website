<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relation between brand and product
    public function product () {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}

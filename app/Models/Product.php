<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relationship between product and vendor
    public function vendor () {
        return $this->belongsTo(User::class,'vendor_id','id');
    }

    //relationship between product and category
    public function category () {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}

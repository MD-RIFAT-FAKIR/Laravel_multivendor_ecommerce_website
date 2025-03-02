<?php

namespace App\Http\Controllers\Backend;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategor;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\Product;

class ProductController extends Controller
{
    //all product
    public function AllProduct() {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }//end
}

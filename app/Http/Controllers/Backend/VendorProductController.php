<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Category;
use App\Models\Subcategor;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class VendorProductController extends Controller
{
    //vendor all product
    public function VendorAllProduct() {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }//end

    //vendor add product
    public function VendorAddProduct() {
        $Brands = Brand::latest()->get();
        $Category = Category::latest()->get();
        
        return view('vendor.backend.product.vendor_product_add', compact('Brands','Category'));
    }//end
}

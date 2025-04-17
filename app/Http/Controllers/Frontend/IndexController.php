<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategor;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{
    //product details page
    public function ProductDetails ($id,$slug) {
        $product = Product::findOrFail($id);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $multiImg = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $related_product = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.product.product_details', compact('product','product_size','product_color','multiImg','related_product'));
    }
}

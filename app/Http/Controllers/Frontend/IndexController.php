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
    public function Index () {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_5 = Category::skip(5)->first();
        $skip_product_5 = Product::where('status',1)->where('category_id',$skip_category_5->id)->orderBy('id','DESC')->limit(5)->get();

        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.index', compact('skip_category_0','skip_product_0','skip_category_2','skip_product_2','skip_category_5','skip_product_5','hot_deals','special_offer'));
    }



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

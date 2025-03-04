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
use App\Models\User;
use Carbon\Carbon;

class ProductController extends Controller
{
    //all product
    public function AllProduct() {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }//end

    //add product
    public function AddProduct() {
        $Brands = Brand::latest()->get();
        $Category = Category::latest()->get();
        $ActiveVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        
        return view('backend.product.product_add', compact('Brands','Category','ActiveVendor'));
    }//end

    //store product
    public function StoreProduct(Request $request) {
        $img = $request->file('product_thambnail');

        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $img = $manager->read($img);
        $img = $img->resize(800,800);

        $img->toJpeg(80)->save(base_path('public/upload/products/thambnails'.$name_gen));
        $save_url = 'upload/products/thambnails'.$name_gen;

        $Product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,

            'product_slug' => strtolower(str_replace('','-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,

            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,

            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        //upload multiple images
        $images = $request->file('multi_img');

        foreach($images as $img) {

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $img = $manager->read($img);
            $img = $img->resize(800,800);
    
            $img->toJpeg(80)->save(base_path('public/upload/products/multi-img'.$name_gen));
            $upload_url = 'upload/products/multi-img'.$name_gen;

            MultiImg::insert([
                'product_id' => $Product_id,
                'photo_name' => $upload_url,
                'created_at' => Carbon::now()
            ]);

        }//end if

        $notification = array (
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.product')->with($notification);
    }
}

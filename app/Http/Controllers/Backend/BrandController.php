<?php

namespace App\Http\Controllers\Backend;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    //Backend all brand
    public function AllBrand() {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }//end

    //Backend add brand
    public function AddBrand() {
        return view('backend.brand.brand_add');
    }
}

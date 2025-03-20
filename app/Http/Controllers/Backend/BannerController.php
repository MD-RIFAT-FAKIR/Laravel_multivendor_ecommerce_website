<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Banner;

class BannerController extends Controller
{
     //all banner
     public function AllBanner() {
        $banner = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banner'));
    }//end
}

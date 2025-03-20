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

    //add banner
    public function AddBanner() {
        return view('backend.banner.banner_add');
    }

     //store banner
     public function StoreBanner(Request $request) {

        if($request->file('banner_image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('banner_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('banner_image'));
            $img = $img->resize(768,450);

            $img->toJpeg(80)->save(base_path('public/upload/banner/'.$name_gen));
            $save_url = 'upload/banner/'.$name_gen;

            Banner::insert([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url
            ]);
        }//end if

        $notification = array (
                'message' => 'Banner Inserted Successfully',
                'alert-type' => 'success'
        );
        
        return redirect()->route('all.banner')->with($notification);

    }//end
}

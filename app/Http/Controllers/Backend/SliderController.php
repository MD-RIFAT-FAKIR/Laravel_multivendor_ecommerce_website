<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Slider;

class SliderController extends Controller
{
     //all slider
     public function AllSlider() {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }//end

    //add slider
    public function AddSlider() {
        return view('backend.slider.slider_add');
    }

     //store slider
     public function StoreSlider(Request $request) {

        if($request->file('slider_image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('slider_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('slider_image'));
            $img = $img->resize(2376,807);

            $img->toJpeg(80)->save(base_path('public/upload/slider/'.$name_gen));
            $save_url = 'upload/slider/'.$name_gen;

            Slider::insert([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url
            ]);
        }//end if

        $notification = array (
                'message' => 'Slider Inserted Successfully',
                'alert-type' => 'success'
        );
        
        return redirect()->route('all.slider')->with($notification);

    }//end

    // edit slider
    public function EditSlider($id) {
        $sliders = Slider::findorFail($id);

        return view('backend.slider.slider_edit', compact('sliders'));
    }//end

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VendorController extends Controller
{
    //
    public function VendorDashboard() {
        return view('vendor.index');
    }
    //vendor login
    public function VendorLogin() {
        return view('vendor.vendor_login');
    }
    //vendor logout
    public function VendorDestroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/vendor/login');
        }//end

    //vendor profile
    public function VendorProfie() {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_profile_view', compact('vendorData'));
    }//end

    //vendor profile store
    public function VendorProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;
        

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('/upload/vendor_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $fileName);
            $data['photo'] = $fileName;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    }
}

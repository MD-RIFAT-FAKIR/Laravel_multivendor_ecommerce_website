<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //admin dashboard
    public function AdminDashboard() {
        return view('admin.index');
    }//end

    //admin login
    public function AdminLogin() {
        return view('Admin.admin_login');
    }//end

    //admin logout
    public function AdminDestroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin/login');
        }//end

    //admin profile
    public function AdminProfile() {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }//end

    //admin profile save changes
    public function AdminProfileSaveChange(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);

            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array (
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end

    //admin change password
    public function AdminChangePassword() {
        return view('admin.admin_change_password');
    }//end

    //admin update password
    public function AdminUpdatePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //match old password with database
        if(!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Does Not Matched");
        }

        //updata new password
        User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully");
    }//end

    //inactive Vendor 
    public function InactiveVendor() {
        $inActiveVendor = User::where('role','vendor')->where('status','inactive')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));
    }//end

    //inactive Vendor 
    public function ActiveVendor() {
        $activeVendor = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }//end

    //inactive vendor details
    public function InactiveVendorDetails($id) {
        $inActiveVendorDetails = User::findOrFail($id);

        return view('backend.vendor.inactive_vendor_details', compact('inActiveVendorDetails'));

    }//end

    //inactive vendor approve
    public function InactiveVendorApprove(Request $request) {
        $vendor_id = $request->id;

        User::findOrFail($vendor_id)->update([
            'status' => 'active'
        ]);

        $notification = array (
            'message' => 'Vendor Activated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('active.vendor')->with($notification);
    }//end

    //active bendor details 
    public function ActiveVendorDetails($id) {
        $activeVendorDetails = User::findOrFail($id);

        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }//end

    //inactive vendor approve
    public function ActiveVendorDisapprove(Request $request) {
        $vendor_id = $request->id;

        User::findOrFail($vendor_id)->update([
            'status' => 'inactive'
        ]);

        $notification = array (
            'message' => 'Vendor Inactivated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('inactive.vendor')->with($notification);
    }//end

}

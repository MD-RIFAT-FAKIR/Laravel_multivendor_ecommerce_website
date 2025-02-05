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



}

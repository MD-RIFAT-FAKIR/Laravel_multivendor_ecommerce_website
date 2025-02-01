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
}

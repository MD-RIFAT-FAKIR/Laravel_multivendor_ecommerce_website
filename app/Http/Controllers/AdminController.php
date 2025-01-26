<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    //admin dashboard
    public function AdminDashboard() {
        return view('admin.index');
    }

    public function AdminLogin() {
        return view('Admin.admin_login');
    }

    //admin logout
    public function AdminDestroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin/login');
        }

}

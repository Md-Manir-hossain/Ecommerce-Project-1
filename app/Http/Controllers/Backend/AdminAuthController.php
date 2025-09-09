<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function adminLogin () 
    {
        return view('backend.admin-login');
    }

    public function logOut () 
    {
        Auth::logout();

        return redirect('/admin/login');
    }
    //
}

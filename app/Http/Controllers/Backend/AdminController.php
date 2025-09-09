<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminDashboard ()
    {
        return view('backend.dashboard');
    }
    //
}

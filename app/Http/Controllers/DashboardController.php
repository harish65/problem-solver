<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('Auth');
    }

    public function index(){ 
        echo "<pre>";print_r(Auth::user());die;
        return view('users.dashboard');
    }
}

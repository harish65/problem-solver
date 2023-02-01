<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('adult.problem.index');
        // if(Auth::user() -> role == 0)
        //     return redirect("adminHome");
        // elseif(Auth::user() -> role == 1)
        //     return redirect("adultHome");
        // elseif(Auth::user() -> role == 2)
        //     return redirect("parentHome");
        // elseif(Auth::user() -> role == 3)
        //     return redirect("childHome");
        // elseif(Auth::user() -> role == 4)
        //     return redirect("teacherHome");
        // elseif(Auth::user() -> role == 5)
        //     return redirect("studentHome");
    }
}

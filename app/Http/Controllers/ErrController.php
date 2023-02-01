<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrController extends Controller
{
    //admin Err
    public function adminErr(){
        return view("error.adminErr");
    }

    //adult Err
    public function adultErr(){
        return view("error.adultErr");
    }

    //child Err
    public function childErr(){
        return view("error.childErr");
    }
}

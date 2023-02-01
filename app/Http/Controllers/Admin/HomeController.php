<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Project;
use Auth;


class HomeController extends Controller
{
    public function index(){
        $project = Project::orderBy("id", "desc")-> get();    
            return view("admin.home.index", ["project" => $project,]);
    }
    
}

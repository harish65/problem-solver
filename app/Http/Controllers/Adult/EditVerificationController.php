<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditVerificationController extends Controller
{
        public function updateVerification(Request $request){
                echo "<pre>";print_r($request->all());die();
        }    
}

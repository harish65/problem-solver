<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\SolutionFunction;
use App\Models\Setting;
use App\Models\Verification;
use App\Models\VerificationType;
use App\Models\VerificationTypeText;
use Auth;

class VerificationController extends Controller
{
    //verification
    public function adultVerification(Request $request){
        $type = $request -> type;

        if($type == 5 || $type == 9 || $type == 10 || $type == 11 || $type == 12 || $type == 13){
            $type = 3;
        }

        if($type == 6 || $type == 7 || $type == 8){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get();
        }elseif($request -> type == 3){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> where("problem_id", "!=", "")
                -> get()
                -> unique('solution_id');

            foreach($verifications as $item){
                $item -> verification = Verification::orderBy("id", "desc")
                -> where("solution_id", $item -> solution_id)
                -> get();
            }
        }elseif($request -> type == 12 ){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get();
        }elseif($request -> type == 13 ){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get();
        }elseif($request -> type == 14){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get();
        }elseif($request -> type == 15){
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get();
        }else{
            $verifications = Verification::orderBy("id", "asc")
                -> where("user_id", Auth::user() -> id)
                -> where("verification_type_id", $type)
                -> get()
                -> unique('solution_id');

            foreach($verifications as $item){
                $item -> verification = Verification::orderBy("id", "desc")
                -> where("solution_id", $item -> solution_id)
                -> get();
            }
        }

        $verificationType = VerificationType::where("id", $request -> type)
            -> first();

        $solFunctions = SolutionFunction::orderBy("id", "asc")
            -> where("user_id", Auth::user() -> id)
            -> get();

        $verificationTypes = VerificationType::orderBy("id", "asc")
            -> get();

        return view("adult.verification.index", [
            "solFunctions" => $solFunctions,
            "verifications" => $verifications,
            "verificationTypes" => $verificationTypes,
            "verificationType" => $verificationType,
        ]);
    }

    public function createVerification(Request $request){
        if($request -> verification_type_id == 1){
            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> problem_id = $request -> problem_id;
            $verification -> solution_id = $request -> solution_id;
            $verification -> solution_function_id = $request -> solution_function_id;
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> type = $request -> type;
    
            $verification -> save();
        }elseif($request -> verification_type_id == 2){
            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> problem_id = $request -> problem_id;
            $verification -> solution_id = $request -> solution_id;
            $verification -> solution_function_id = $request -> solution_function_id;
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> type = $request -> type;
            $verification -> key = "Identified Information";
            $verification -> val = "Given Information";
            $verification -> vals = "Entity";
    
            $verification -> save();
        }elseif($request -> verification_type_id == 3){
            $request->validate([
                'val' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> problem_id = $request -> problem_id;
            $verification -> solution_id = $request -> solution_id;
            $verification -> solution_function_id = $request -> solution_function_id;
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> type = $request -> type;

            if($request -> key){
                $verification -> key = $request -> key;
            }else{
                $verification -> key = "";
            }
            $verification -> val = $request -> val;

            if($request -> file_type == 0){
                if($request->hasFile('file')){
                    $request -> validate([
                        'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                    ]);
                    $file = time().'.'.$request -> file -> extension();
                    $request -> file -> move(public_path('assets/verification/'), $file);
    
                    $mime = mime_content_type(public_path('assets/verification/' . $file));
                    if(strstr($mime, "video/")){
                        $verification -> file_type = 1;
                    }else if(strstr($mime, "image/")){
                        $verification -> file_type = 0;
                    }
        
        
                    $verification -> file = $file;
                }
            }elseif($request -> file_type == 2){
                $verification -> file_type = $request -> type;
                $verification -> file = $request -> link;
            }
    
            $verification -> save();
        }elseif($request -> verification_type_id == 6){
            $request->validate([
                'key' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> key = $request -> key;
            $verification -> val = $request -> val;

            $verification -> save();

        }elseif($request -> verification_type_id == 7){
            $request->validate([
                'key' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> problem_id = $request -> problem_id;
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> key = $request -> key;

            $verification -> save();
        }elseif($request -> verification_type_id == 8){
            $request->validate([
                'key' => 'required',
                'val' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> solution_id = $request -> solution_id;
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> key = $request -> key;
            $verification -> val = $request -> val;
            $verification -> type = $request -> type;

            $verification -> save();
        }elseif($request -> verification_type_id == 11){
            $request->validate([
                'val' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> verification_type_id = 3;
            if($request -> key){
                $verification -> key = $request -> key;
            }else{
                $verification -> key = "";
            }
            $verification -> val = $request -> val;
            if($request -> file_type == 0){
                if($request->hasFile('file')){
                    $request -> validate([
                        'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                    ]);
                    $file = time().'.'.$request -> file -> extension();
                    $request -> file -> move(public_path('assets/verification/'), $file);
    
                    $mime = mime_content_type(public_path('assets/verification/' . $file));
                    if(strstr($mime, "video/")){
                        $verification -> file_type = 1;
                    }else if(strstr($mime, "image/")){
                        $verification -> file_type = 0;
                    }
        
        
                    $verification -> file = $file;
                }
            }elseif($request -> file_type == 2){
                $verification -> file_type = $request -> type;
                $verification -> file = $request -> link;
            }
            $verification -> save();
        }elseif($request -> verification_type_id == 13){
            $request->validate([
                'key' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> verification_type_id = 13;
            $verification -> key = $request -> key . ",";
            $verification -> val = $request -> val;

            if($request -> file_type == 0){
                if($request->hasFile('file')){
                    $request -> validate([
                        'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                    ]);
                    $file = time().'.'.$request -> file -> extension();
                    $request -> file -> move(public_path('assets/verification/'), $file);
    
                    $mime = mime_content_type(public_path('assets/verification/' . $file));
                    if(strstr($mime, "video/")){
                        $verification -> file_type = 1;
                    }else if(strstr($mime, "image/")){
                        $verification -> file_type = 0;
                    }
        
        
                    $verification -> file = $file;
                }
            }elseif($request -> file_type == 2){
                $verification -> file_type = $request -> type;
                $verification -> file = $request -> link;
            }
            $verification -> save();
        }elseif($request -> verification_type_id == 15){
            $request->validate([
                'key' => 'required',
            ]);

            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> verification_type_id = 15;
            $verification -> type = $request -> type;
            $verification -> key = $request -> key;
            $verification -> val = $request -> val;
            $verification -> save();
        }elseif($request -> verification_type_id == 17){
            $verification = new Verification();
            $verification -> user_id = Auth::user() -> id;      
            $verification -> verification_type_id = $request -> verification_type_id;
            $verification -> problem_id = $request -> problem_id;
            $verification -> solution_id = $request -> solution_id;
            $verification -> solution_function_id = $request -> solution_function_id;
            $verification -> save();
        }
        
        return back() -> with("success", "Verification has been created successfully.");
    }

    public function createVerificationByPlus(Request $request){
        $solFunction = SolutionFunction::where("id", $request -> createVerificationByPlusSolFunctionId)
            -> first();
            
        $verification = new Verification();

        if($request -> createVerificationByPlusVerificationTypeId == 1){
            $verification -> user_id = Auth::user() -> id;
            $verification -> problem_id = $solFunction -> problem_id;
            $verification -> solution_id = $solFunction -> solution_id;
            $verification -> solution_function_id = $request -> createVerificationByPlusSolFunctionId;
            $verification -> verification_type_id = $request -> createVerificationByPlusVerificationTypeId;
            $verification -> key = $request -> createVerificationByPlusKey;
            $verification -> val = $request -> createVerificationByPlusVal;
            $verification -> type = $request -> createVerificationByPlusType;
        }elseif($request -> createVerificationByPlusVerificationTypeId == 2){
            $verification -> user_id = Auth::user() -> id;
            $verification -> problem_id = $solFunction -> problem_id;
            $verification -> solution_id = $solFunction -> solution_id;
            $verification -> solution_function_id = $request -> createVerificationByPlusSolFunctionId;
            $verification -> verification_type_id = $request -> createVerificationByPlusVerificationTypeId;
            $verification -> key = $request -> createVerificationByPlusKey;
            $verification -> val = $request -> createVerificationByPlusVal;
            $verification -> vals = $request -> createVerificationByPlusVals;
            $verification -> type = $request -> createVerificationByPlusType;
        }
        

        $verification -> save();

        return back() -> with("success", "Verification has been created successfully.");
    }

    public function updateVerifications(Request $request){
        if($request  -> updateVerificationsTypeId == 8){
            Verification::where("id", $request -> updateVerificationsId)
                -> update([
                        "solution_id" => $request -> updateVerificationsSolutionId,
                        "type" => $request -> updateVerificationsType,
                        "key" => $request -> updateVerificationsKey,
                        "val" => $request -> updateVerificationsVal,
                    ]);
        }elseif($request -> updateVerificationsTypeId == 6){
            Verification::where("id", $request -> updateVerificationsId)
                -> update([
                    "key" => $request -> updateVerificationsKey,
                    "val" => $request -> updateVerificationsVal,
                ]);
        }elseif($request -> updateVerificationsTypeId == 7){
            Verification::where("id", $request -> updateVerificationsId)
                -> update([
                    "key" => $request -> updateVerificationsKey,
                    "problem_id" => $request -> updateVerificationsProblemId,
                ]);
        }elseif($request -> updateVerificationsTypeId == 12){
            $request->validate([
                'updateVerificationsKey' => 'required',
            ]);

            Verification::where("id", $request -> updateVerificationsId)
                -> update([
                    "key" => $request -> updateVerificationsKey,
                ]);
        }elseif($request -> updateVerificationsTypeId == 13){
            $request->validate([
                "updateVerificationsVal" => 'required',
            ]);
            $key = "";

            if($request -> updateVerificationsKey){
                $key = $request -> updateVerificationsKey;
            }

            Verification::where("id", $request -> updateVerificationsId)
                -> update([
                    "key" => $key . ",",
                    "val" => $request -> updateVerificationsVal,
                ]);

            $defaultType = Verification::where("id", $request -> updateVerificationsId)
                -> value("file_type");

            if($request -> updateVerificationsFType  == 0){
                if($request->hasFile('updateVerificationsFile')){
                    $request -> validate([
                        'updateVerificationsFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                    ]);
                    $file = time().'.'.$request -> updateVerificationsFile -> extension();
                    $request -> updateVerificationsFile -> move(public_path('assets/verification/'), $file);
    
                    $mime = mime_content_type(public_path('assets/verification/' . $file));
                    if(strstr($mime, "video/")){
                        $type = 1;
                    }else if(strstr($mime, "image/")){
                        $type = 0;
                    }
    
                    Verification::where("id", $request -> updateVerificationsId)
                        -> update([
                            "file" => $file,
                            "file_type" => $type
                        ]);
                }else{
                    Verification::where("id", $request -> updateVerificationsId)
                        -> update([
                            "file_type" => 0,
                        ]);
                }
    
                if($defaultType == 1){
                    Verification::where("id", $request -> updateVerificationsId)
                        -> update([
                            "file_type" => 1,
                        ]);
                }
            }elseif($request -> updateVerificationsFType == 2){
                $request -> validate([
                    'updateVerificationsLink' => 'required|url',
                ]);
    
                Verification::where("id", $request -> updateVerificationsId)
                    -> update([
                        "file_type" => $request -> updateVerificationsFileType,
                        "file" => $request -> updateVerificationsLink,
                    ]);
            }
        }else{
            Verification::where("solution_function_id", $request -> updateVerificationsSolFunctionId)
                -> update([
                    "problem_id" => $request -> updateVerificationsProblemId,
                    "solution_id" => $request -> updateVerificationsSolutionId,
                    "solution_function_id" => $request -> updateVerificationsSolFunctionId,
                    "type" => $request -> updateVerificationsType,
                ]);

            if($request -> updateVerificationsTypeId == 3 || $request -> updateVerificationsTypeId == 13){
                $request->validate([
                    "updateVerificationsVal" => 'required',
                ]);
                $key = "";

                if($request -> updateVerificationsKey){
                    $key = $request -> updateVerificationsKey;
                }

                Verification::where("id", $request -> updateVerificationsId)
                    -> update([
                        "key" => $key,
                        "val" => $request -> updateVerificationsVal,
                    ]);

                $defaultType = Verification::where("id", $request -> updateVerificationsId)
                    -> value("file_type");

                if($request -> updateVerificationsFType  == 0){
                    if($request->hasFile('updateVerificationsFile')){
                        $request -> validate([
                            'updateVerificationsFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                        ]);
                        $file = time().'.'.$request -> updateVerificationsFile -> extension();
                        $request -> updateVerificationsFile -> move(public_path('assets/verification/'), $file);
        
                        $mime = mime_content_type(public_path('assets/verification/' . $file));
                        if(strstr($mime, "video/")){
                            $type = 1;
                        }else if(strstr($mime, "image/")){
                            $type = 0;
                        }
        
                        Verification::where("id", $request -> updateVerificationsId)
                            -> update([
                                "file" => $file,
                                "file_type" => $type
                            ]);
                    }else{
                        Verification::where("id", $request -> updateVerificationsId)
                            -> update([
                                "file_type" => 0,
                            ]);
                    }
        
                    if($defaultType == 1){
                        Verification::where("id", $request -> updateVerificationsId)
                            -> update([
                                "file_type" => 1,
                            ]);
                    }
                }elseif($request -> updateVerificationsFType == 2){
                    $request -> validate([
                        'updateVerificationsLink' => 'required|url',
                    ]);
        
                    Verification::where("id", $request -> updateVerificationsId)
                        -> update([
                            "file_type" => $request -> updateVerificationsFileType,
                            "file" => $request -> updateVerificationsLink,
                        ]);
                }
            
            }
        }
        
        return back() -> with("success", "Verifications has been updated successfully."); 
    }

    public function updateVerification(Request $request){
        $verificationType = Verification::where("id", $request -> updateVerificationId)
            -> value('verification_type_id');

        if($verificationType == 1){
            $request->validate([
                'updateVerificationKey' => 'required',
                "updateVerificationVal" => 'required',
            ]);
    
            Verification::where("id", $request -> updateVerificationId)
                -> update([
                    "key" => $request -> updateVerificationKey,
                    "val" => $request -> updateVerificationVal,
                ]);
        }elseif($verificationType == 2){
            $request->validate([
                'updateVerificationKey' => 'required',
                "updateVerificationVal" => 'required',
                "updateVerificationVals" => 'required',
            ]);
    
            Verification::where("id", $request -> updateVerificationId)
                -> update([
                    "key" => $request -> updateVerificationKey,
                    "val" => $request -> updateVerificationVal,
                    "vals" => $request -> updateVerificationVals,
                ]);
        }
        
        
        return back() -> with("success", "Verification has been updated successfully.");
    }

    public function delVerification(Request $request){
        Verification::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Verification has been deleted successfully.");
    }

    public function delVerifications(Request $request){
        Verification::where("solution_function_id", $request -> solution_function_id)
            -> delete();

        return back() -> with("success", "Verification has been deleted successfully.");
    }

    public function getSolFunctionPerProblem(Request $request){
        $solFunctions = SolutionFunction::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> where("problem_id", $request -> id)
            -> get();

        return view("adult.verification.getSolFunctionPerProblem", [
            "solFunctions" => $solFunctions,
        ]);
    }

    public function getSolFunctionPerSolution(Request $request){
        $solFunctions = SolutionFunction::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> where("solution_id", $request -> id)
            -> get();

        return view("adult.verification.getSolFunctionPerProblem", [
            "solFunctions" => $solFunctions,
        ]);
    }

    public function updateVerificationType(Request $request){
        $request->validate([
            'updateVerificationTypeKey' => 'required|max:255',
            'updateVerificationTypeVal' => 'required|max:255',
        ]);

        VerificationType::where("id", $request -> updateVerificationTypeId)
            -> update([
                "user_id" => Auth::user() -> id,
                "key" => $request -> updateVerificationTypeKey,
                "val" => $request -> updateVerificationTypeVal,
            ]);

        return back() -> with("success", "Verification type has been updated successfully.");      
    }

    public function getProblemPerSolFunction(Request $request){
        $problem_id = SolutionFunction::where('id', $request -> id)
            -> value("problem_id");

        $problems = Problem::where("id", $problem_id)
            -> get();
        
        return view("adult.verification.getProblemPerSolFunction", [
            "problems" => $problems,
        ]);
    }

    public function getSolutionPerSolFunction(Request $request){
        $solution_id = SolutionFunction::where('id', $request -> id)
            -> value("solution_id");

        $solutions = Solution::where("id", $solution_id)
            -> get();
        
        return view("adult.verification.getSolutionPerSolFunction", [
            "solutions" => $solutions,
        ]);
    }

    public function getVerificationTypeTextPerType(Request $request){
        $texts = VerificationTypeText::where("verification_type_id", $request -> id)
            -> get();
        
        return view("adult.verification.getVerificationTypeTextPerType", [
            "texts" => $texts,
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use Auth;
use DB;
use Validator;
use App\Models\User;
use App\Models\Problem;

class ApiController extends BaseController
{
    //Add / Edit problem
    public function storeProblem(Request $request)
    {
        //    echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "category_id" => "required",
            "project_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            if ($request->problemType == 0) {
                $file = null;
                $type = null;
                if ($request->hasFile("file")) {
                    $file = time() . "." . $request->file->extension();
                    $request->file->move(
                        public_path("assets-new/problem/"),
                        $file
                    );
                    $mime = mime_content_type(
                        public_path("assets-new/problem/" . $file)
                    );
                    if (strstr($mime, "video/")) {
                        $type = 1;
                    } elseif (strstr($mime, "image/")) {
                        $type = 0;
                    }
                }

                $insert = DB::table("problems")->updateOrInsert(
                    ["id" => $request->id],
                    [
                        "user_id" => Auth::user()->id,
                        "project_id" => $request->project_id,
                        "category_id" => $request->category_id,
                        "name" => $request->name,
                        "file" => $file,
                        "type" => $type,
                        "created_at" => date("Y-m-d h:i:s"),
                    ]
                );
            } elseif ($request->problemType == 2) {
                $validator = Validator::make($request->all(), [
                    "link" => "required|url",
                    "category_id" => "required",
                ]);
                if ($validator->fails()) {
                    return $this->sendError(
                        "Validation Error.",
                        $validator->errors()
                    );
                }

                $insert = DB::table("problems")->updateOrInsert(
                    ["id" => $request->id],
                    [
                        "user_id" => Auth::user()->id,
                        "project_id" => $project_id,
                        "category_id" => $request->category_id,
                        "name" => $request->name,
                        "type" => $request->problemType,
                        "file" => $request->link,
                        "created_at" => date("Y-m-d h:i:s"),
                    ]
                );
            }
            $problem = DB::table("problems")
                ->where("project_id", "=", $request->project_id)
                ->first();

            $success["type"] = $insert;
            $success["problem"] = $problem;
            $success["token"] = $request->header("Authorization");
            return $this->sendResponse($success, "Problem saved successfully.");
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()]);
        }
    }
    //Update problem validation questions
    public function updateValidation(Request $request)
    {
        $update = DB::table("problems")
            ->where("id", "=", $problemID)
            ->where("project_id", "=", $projectID)
            ->update([
                "validation" => $request->input("value"),
            ]);
        if ($update) {
            return true;
        }
    }

    public function deleteProblem(Request $request)
    {
        try {
            //check if solution exist
            $solution = DB::table("solutions")
                ->where("problem_id", $request->input("id"))
                ->first();
            if (isset($solution->id)) {
                return $this->sendError("Error.", [
                    "error" =>
                        "Problem can't' be deleted. Used for other purpose.",
                ]);
            }
            
            // $problem = DB::table("problems")
            //     ->where("id", $request->input("id"))
            //     ->delete();
                $problem = Problem::find($request->id);
            if ($problem) {
                $file_name = $problem->file;
                $file = public_path("assets-new/problem/".$file_name);
                unlink($file);
                $problem->delete();
                $success["problem"] = $problem;
                $success["token"] = $request->header("Authorization");
                return $this->sendResponse(
                    $success,
                    "Problem deleted successfully."
                );
            } else {
                return $this->sendError("Error.", [
                    "error" => "Problem not exist!",
                ]);
            }
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()]);
        }
    }

    //Upload user profile pic API
    public function uploadProfilePic(Request $request)
    {
        try {
            $file = time() . "." . $request->avatar->extension();
            $request->avatar->move(public_path("assets-new/avatar/"),$file);            
            $user = User::where("id", "=", $request->id)->update([
                "avatar" => $file,
            ]);
            if ($user) {
                $success["token"] = $request->header("Authorization");
                $success["image"] = $file;
                $success["user"] = Auth::user();
                return $this->sendResponse(
                    $success,
                    "Image Saved successfully."
                );
            }
        } catch (Exception $e) {
            return response()->json(["Error." => $e->getMessage()]);
        }
    }

    //Problem API's
    public function getProblem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "project_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }       
        $cat = DB::table("problem_categories")->get();
        $problem = DB::table("problems")
            ->where("id", "=", $request->id)
            ->first();

        if ($problem) {
            $success["token"] = $request->header("Authorization");
            $success["problem"] = $problem;
            $success["cat"] = $cat;
            $success["project_id"] = $request->project_id;
            return $this->sendResponse($success, "true");
        } else {
            $success["token"] = $request->header("Authorization");
            $success["problem"] = null;
            return $this->sendResponse($success, "true");
        }
    }
}

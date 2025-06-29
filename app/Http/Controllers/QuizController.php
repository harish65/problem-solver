<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Quiz;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;

class QuizController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function index($projectID)
    {
        $projectID   = Crypt::decrypt($projectID);
        $quizzes  = DB::table('quizzes')->where('project_id', $projectID)->get();
            
        return view('quiz.index' , ['projectID' => $projectID , 'quizzes' => $quizzes]);
    }
    public function addQuiz($projectID)
    {
        
        $projects = Project::where('user_id', auth()->user()->id)->get();
        $quizTypes  = DB::table('quiz_types')->get();
        return view('quiz.add' , ['projects'=>$projects , 'quizTypes' => $quizTypes , 'projectID'=> $projectID]);
    }

    public function store(Request $request)
    {
        
        try {
            $validator = Validator::make($request->all(), [
               'quiz_type' => 'required',
                'page_id' => 'required',
                'quiz_title' => 'required',
            ], [
                'quiz_type.required' => 'Please select a quiz type.',
                'page_id.required' => 'Page is required.',
                'quiz_title.required' => 'Quiz title cannot be empty.',
            ]);
         
            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->with('errors', $validator->errors());
                
            }
            // echo $request->project_id;die;
            $projectID = Crypt::decrypt($request->project_id);
            $checkQuisExist = DB::table('quizzes')->where('project_id', $projectID)->where('page_id', $request->page_id)->first();
            if($checkQuisExist){
                return back()->with('error', 'Quiz already exists for this page.');
            }
            $quiz =  new Quiz();
            $quiz->user_id = Auth::user()->id;
            $quiz->project_id = $projectID;
            $quiz->page_id  =  $request->page_id;
            $quiz->page_type  =  $request->page_type;
            $quiz->quiz_title = $request->quiz_title;
            $quiz->quiz_type = $request->quiz_type;
            $quiz->quiz_data = json_encode($request->quiz_data);
            $quiz->created_at = now();
            if($quiz->save()){
                return redirect()->route('quiz', ['id' => Crypt::encrypt($projectID)])->with('success', 'Quiz added successfully.');
            }
    } catch (\Exception $e) { 
        return back()->with('error', 'An unexpected error occurred.');
    }
       
    }
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $quiz = DB::table('quizzes')->where('id', $id)->first();
        $quizTypes  = DB::table('quiz_types')->get();
        return view('quiz.edit' , ['quiz'=>$quiz , 'quizTypes' => $quizTypes]);
    }

    public function getQuiz(Request $request)
    {

        try {
            $userId = (isset($request->user_id))?Crypt::decrypt($request->user_id):null;
            $projectId = null;
            $pageType = $request->page_type ?? null;
            $pageId = $request->page_id ?? null;


            if ($request->project_id) {
                $projectId = Crypt::decrypt($request->project_id);
            }

            if(isset($userId)){
                $quiz = Quiz::where([
                'project_id' => $projectId,
                'page_id' => $pageId,
                'page_type' => $pageType,
                'user_id' => Auth::user()->id,
            ])->first();
            }else{            
                $quiz = Quiz::where(['project_id'=>$projectId , 'page_id'=>$pageId , 'page_type'=> $pageType])->first();
            }

            if(isset($quiz)){

                $alreadySubmitted = false;
                $isPermitted = Quiz::isProjectQuizEditable($projectId);
                $isProjectOwner = $request->is_owner??false;
                $submitted = $request->submitted ?? false;
                $is_permitted = $request->is_permitted ?? false;
                $questionIndex =0;
                $editUserId = null;
                if(!isset($userId) && !$isProjectOwner){
                    $editUserId = Auth::user()->id;
                    
                }

                $userQuiz = DB::table('quiz_data')
                    ->where([
                        'user_id' => $editUserId?$editUserId:$userId,
                        'quiz_id' => $quiz->id,
                    ])
                    ->first();


                return response()->json([
                    'success' => true,
                    'html' => view('quiz.components.quiz', compact(
                        'quiz', 'userQuiz', 'isPermitted', 'isProjectOwner', 'submitted', 'questionIndex', 'userId'
                    ))->render()
                ]);
            }else{
                return response()->json(['success' => false, 'error' => 'Quiz not found.'], 404);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to load quiz.' . $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
            //    'quiz_type' => 'required',
                'page_id' => 'required',
                'quiz_title' => 'required',
            ], [
                // 'quiz_type.required' => 'Please select a quiz type.',
                'page_id.required' => 'Page is required.',
                'quiz_title.required' => 'Quiz title cannot be empty.',
            ]);
         
            if ($validator->fails()) {
                return back()->with('errors', $validator->errors());
                
            }
            
            $id = Crypt::decrypt($id);
            
            DB::table('quizzes')->where('id', $id)->update([
                
                'quiz_title' => $request->quiz_title,
                'page_id' => $request->page_id,
                'quiz_data' => json_encode($request->quiz_data)
            ]);
            
            return redirect()->route('quiz', ['id' => Crypt::encrypt($request->project_id)])->with('success', 'Quiz updated successfully.');
            
    
        }catch(Exception $e) {
            echo $e->getMessage();die;
            return back()->with('error', 'An unexpected error occurred.');
        }
    }
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        DB::table('quizzes')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Quiz deleted successfully.');
    }
    public function getQuizzes($projectID)
    {
        $projectID = Crypt::decrypt($projectID);
        $quizzes = DB::table('quizzes')->where('project_id', $projectID)->get();
        return response()->json($quizzes);
    }


    public function saveQuizData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'quiz_data' => 'required|array',
                'project_id' => 'required|integer',
            ]);
        if ($validator->fails()) {                        
            return back()->with('errors', $validator->errors());
        }

        $quizData = $request->input('quiz_data.exptoexp', []);
        if(isset($quizData)){
            foreach ($quizData as $key => $item) {
                $answer = trim(strip_tags($item['exptoexp_answer'] ?? ''));
                if (empty($answer)) {
                    return back()->withErrors([
                        "quiz_data.exptoexp.{$key}.exptoexp_answer" => "Answer for Question " . ($key + 1) . " is required."
                    ])->withInput();
                }
            }
        }


        $quizData = $request->input('quiz_data.exp', null);
        if (isset($quizData) && (!isset($quizData['answer']) || trim(strip_tags($quizData['answer'])) === '')) {
            return back()->withErrors([
                "quiz_data.exp.answer" => "Answer for Question is required."
            ])->withInput();
        }

        $insert = DB::table("quiz_data")->updateOrInsert(
            ["id" => $request->id],
            [
                "user_id"=> Auth::user()->id,
                "quiz_id" => $request->quiz_id,
                "project_id" => $request->project_id,
                "quiz_data" => json_encode($request->quiz_data),
                "created_at" => now()
            ]
        );
        return redirect()->back()->with('success', 'Quiz saved successfully.');
        
        } catch (\Exception $e) { echo $e->getMessage();die;
            return back()->with('error', 'An unexpected error occurred.');
        }
    }
    
}

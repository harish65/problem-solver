<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Quiz;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;

class QuizApiController extends Controller
{
    /**
     * Display a listing of quizzes for a project.
     */
    public function index(Request $request, $projectID)
    {
        try {
            $projectID = Crypt::decrypt($projectID);
            $quizzes = DB::table('quizzes')
                ->where('project_id', $projectID)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $quizzes,
                'message' => 'Quizzes retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quizzes.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created quiz.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'quiz_type' => 'required|integer',
                'project_id' => 'required|string',
                'page_id' => 'required|integer',
                'page_type' => 'nullable|integer',
                'quiz_title' => 'required|string|max:255',
                'quiz_data' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            $projectID = Crypt::decrypt($request->project_id);

            // Check if quiz already exists for this page
            $checkQuizExist = DB::table('quizzes')
                ->where('project_id', $projectID)
                ->where('page_id', $request->page_id)
                ->first();

            if ($checkQuizExist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz already exists for this page.'
                ], 409);
            }

            $quiz = new Quiz();
            $quiz->user_id = Auth::user()->id;
            $quiz->project_id = $projectID;
            $quiz->page_id = $request->page_id;
            $quiz->page_type = $request->page_type;
            $quiz->quiz_title = $request->quiz_title;
            $quiz->quiz_type = $request->quiz_type;
            $quiz->quiz_data = json_encode($request->quiz_data);
            $quiz->created_at = now();
            $quiz->save();

            return response()->json([
                'success' => true,
                'data' => $quiz,
                'message' => 'Quiz added successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified quiz.
     */
    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $quiz = DB::table('quizzes')
                ->where('id', $id)
                ->first();

            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found.'
                ], 404);
            }

            // Decode quiz_data if it exists
            if ($quiz->quiz_data) {
                $quiz->quiz_data = json_decode($quiz->quiz_data);
            }

            $quizTypes = DB::table('quiz_types')->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => $quiz,
                    'quiz_types' => $quizTypes
                ],
                'message' => 'Quiz retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quiz.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get quiz by project, page, and user criteria.
     */
    public function getQuiz(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|string',
                'project_id' => 'nullable|string',
                'page_type' => 'nullable|integer',
                'page_id' => 'nullable|integer',
                'is_owner' => 'nullable|boolean',
                'submitted' => 'nullable|boolean',
                'is_permitted' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            $userId = $request->user_id ? Crypt::decrypt($request->user_id) : null;
            $projectId = $request->project_id ? Crypt::decrypt($request->project_id) : null;
            $pageType = $request->page_type ?? null;
            $pageId = $request->page_id ?? null;

            $quizQuery = Quiz::where([
                'project_id' => $projectId,
                'page_id' => $pageId,
                'page_type' => $pageType,
            ]);

            if ($userId) {
                $quizQuery->where('user_id', Auth::user()->id);
            }

            $quiz = $quizQuery->first();

            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found.'
                ], 404);
            }

            // Decode quiz_data
            if ($quiz->quiz_data) {
                $quiz->quiz_data = json_decode($quiz->quiz_data);
            }

            $isPermitted = Quiz::isProjectQuizEditable($projectId);
            $isProjectOwner = $request->is_owner ?? false;
            $submitted = $request->submitted ?? false;
            
            $editUserId = null;
            if (!$userId && !$isProjectOwner) {
                $editUserId = Auth::user()->id;
            }

            $userQuiz = DB::table('quiz_data')
                ->where([
                    'user_id' => $editUserId ?: $userId,
                    'quiz_id' => $quiz->id,
                ])
                ->first();

            if ($userQuiz && $userQuiz->quiz_data) {
                $userQuiz->quiz_data = json_decode($userQuiz->quiz_data);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => $quiz,
                    'user_quiz' => $userQuiz,
                    'is_permitted' => $isPermitted,
                    'is_project_owner' => $isProjectOwner,
                    'submitted' => $submitted,
                ],
                'message' => 'Quiz retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load quiz.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified quiz.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required|integer',
                'quiz_title' => 'required|string|max:255',
                'quiz_data' => 'nullable|array',
                'project_id' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            $id = Crypt::decrypt($id);

            $quiz = DB::table('quizzes')->where('id', $id)->first();
            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found.'
                ], 404);
            }

            DB::table('quizzes')->where('id', $id)->update([
                'quiz_title' => $request->quiz_title,
                'page_id' => $request->page_id,
                'quiz_data' => json_encode($request->quiz_data),
                'updated_at' => now()
            ]);

            $updatedQuiz = DB::table('quizzes')->where('id', $id)->first();
            if ($updatedQuiz->quiz_data) {
                $updatedQuiz->quiz_data = json_decode($updatedQuiz->quiz_data);
            }

            return response()->json([
                'success' => true,
                'data' => $updatedQuiz,
                'message' => 'Quiz updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified quiz.
     */
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $quiz = DB::table('quizzes')->where('id', $id)->first();
            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found.'
                ], 404);
            }

            // Optionally delete related quiz_data
            DB::table('quiz_data')->where('quiz_id', $id)->delete();
            DB::table('quizzes')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Quiz deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete quiz.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all quizzes for a project (JSON response).
     */
    public function getQuizzes($projectID)
    {
        try {
            $projectID = Crypt::decrypt($projectID);
            $quizzes = DB::table('quizzes')
                ->where('project_id', $projectID)
                ->get();

            // Decode quiz_data for each quiz
            foreach ($quizzes as $quiz) {
                if ($quiz->quiz_data) {
                    $quiz->quiz_data = json_decode($quiz->quiz_data);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $quizzes,
                'message' => 'Quizzes retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quizzes.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Save quiz data (user responses).
     */
    public function saveQuizData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'quiz_data' => 'required|array',
                'project_id' => 'required|integer',
                'quiz_id' => 'required|integer',
                'id' => 'nullable|integer', // quiz_data record id
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Validate exp to exp answers if present
            $quizData = $request->input('quiz_data.exptoexp', []);
            if (!empty($quizData)) {
                foreach ($quizData as $key => $item) {
                    $answer = trim(strip_tags($item['exptoexp_answer'] ?? ''));
                    if (empty($answer)) {
                        return response()->json([
                            'success' => false,
                            'message' => "Answer for Question " . ($key + 1) . " is required.",
                            'field' => "quiz_data.exptoexp.{$key}.exptoexp_answer"
                        ], 422);
                    }
                }
            }

            // Validate exp answer if present
            $expQuizData = $request->input('quiz_data.exp', null);
            if (isset($expQuizData) && (!isset($expQuizData['answer']) || trim(strip_tags($expQuizData['answer'])) === '')) {
                return response()->json([
                    'success' => false,
                    'message' => "Answer for Question is required.",
                    'field' => "quiz_data.exp.answer"
                ], 422);
            }

            $insert = DB::table("quiz_data")->updateOrInsert(
                ["id" => $request->id],
                [
                    "user_id" => Auth::user()->id,
                    "quiz_id" => $request->quiz_id,
                    "project_id" => $request->project_id,
                    "quiz_data" => json_encode($request->quiz_data),
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );

            $quizDataRecord = null;
            if ($request->id) {
                $quizDataRecord = DB::table('quiz_data')->where('id', $request->id)->first();
            } else if ($insert) {
                $quizDataRecord = DB::table('quiz_data')
                    ->where('quiz_id', $request->quiz_id)
                    ->where('user_id', Auth::user()->id)
                    ->latest()
                    ->first();
            }

            return response()->json([
                'success' => true,
                'data' => $quizDataRecord,
                'message' => 'Quiz saved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update remarks for a quiz submission.
     */
    public function updateRemarks(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'quiz_id' => 'required|integer',
                'remarks' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            $affected = DB::table('quiz_data')
                ->where('quiz_id', $request->quiz_id)
                ->update([
                    'remarks' => $request->remarks,
                    'updated_at' => now()
                ]);

            if ($affected === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz data not found for the given quiz ID.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Remarks updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get quiz types.
     */
    public function getQuizTypes()
    {
        try {
            $quizTypes = DB::table('quiz_types')->get();

            return response()->json([
                'success' => true,
                'data' => $quizTypes,
                'message' => 'Quiz types retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quiz types.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user projects for quiz creation.
     */
    public function getUserProjects()
    {
        try {
            $projects = Project::where('user_id', auth()->user()->id)->get();

            return response()->json([
                'success' => true,
                'data' => $projects,
                'message' => 'Projects retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve projects.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
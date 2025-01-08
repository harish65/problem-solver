<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [\App\Http\Controllers\Adult\LoginController::class, 'postLogin'])->name('login');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::middleware('auth:api')->group( function () {
    Route::get('/dashborad', [\App\Http\Controllers\Adult\ProjectController::class, 'index'])->name('dashborad');
    Route::post('/create-project', [\App\Http\Controllers\Adult\ProjectController::class, 'store'])->name('create-project');
    Route::post('/delete-project', [\App\Http\Controllers\Adult\ProjectController::class, 'destroy'])->name('delete-project');
    
    
    //User profile pic API
    Route::post('/upload-profile-pic', [\App\Http\Controllers\API\ApiController::class, 'uploadProfilePic'])->name('upload-profile-pic');
    // Probelm Routes
    Route::get("/problem", [\App\Http\Controllers\API\ApiController::class, 'getProblem'])-> name("problem");
    Route::post("/store-problem", [\App\Http\Controllers\API\ApiController::class, 'storeProblem'])-> name("store-problem");
    Route::post("/delete-problem", [\App\Http\Controllers\API\ApiController::class, 'deleteProblem'])-> name("delete-problem");
    Route::post('/problem-validation', [\App\Http\Controllers\API\ApiController::class, 'updateProblemValidation'])->name('problem-validation');
    Route::get('/get-problem-category', [\App\Http\Controllers\API\ApiController::class, 'getProblemCategoery'])->name('get-problem-category');

    // Solution Routes
    Route::get("/solution", [\App\Http\Controllers\API\ApiController::class, 'getSolution'])-> name("solution");
    Route::post("/store-solution", [\App\Http\Controllers\API\ApiController::class, 'storeSolution'])-> name("store-solution");
    Route::post("/delete-solution", [\App\Http\Controllers\API\ApiController::class, 'deleteSolution'])-> name("delete-solution");
    Route::get("/get-solution-type", [\App\Http\Controllers\API\ApiController::class, 'getSolutionType'])-> name("get-solution-type");  
    Route::post("/upadate-solution-valiadtion", [\App\Http\Controllers\API\ApiController::class, 'updateSolutionValidation'])-> name("upadate-solution-valiadtion"); 
    
    

    // /Solution function
    Route::get("/solution-fun", [\App\Http\Controllers\API\ApiController::class, 'getSolutionFunction'])-> name("solution-fun");
    Route::post("/add-sol-fun", [\App\Http\Controllers\API\ApiController::class, 'storeSolutionFunction'])-> name("add-sol-fun");
    Route::post("/delete-sol-fun", [\App\Http\Controllers\API\ApiController::class, 'deleteSolutionFunction'])-> name("delete-sol-fun");
    Route::post("/validation-sol-fun", [\App\Http\Controllers\API\ApiController::class, 'updateValidationSolutionFunction'])-> name("validation-sol-fun");


    //Solutionf function Type
    Route::get("solutiofunctiontype", [\App\Http\Controllers\Adult\SolutionFuntionTypeController::class, 'index'])-> name("solutiofunctiontype");


    //Verification_api's
    Route::get("verifications", [\App\Http\Controllers\API\ApiVerificationController::class, 'GetAllVerifications'])-> name("verifications");
    Route::get("/verification", [\App\Http\Controllers\API\ApiVerificationController::class, 'GetSingleVerification']);

    //Verification Entity Routes
    Route::post("addVocabularyEntity", [\App\Http\Controllers\Adult\VerificationController::class, 'addVocabularyEntity'])-> name("addVocabularyEntity");
    Route::post("deleteVocabulary", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteVocabulary'])-> name("deleteVocabulary");
    //Identify Vocab Verification
    Route::post("store-voucab-verification", [\App\Http\Controllers\Adult\ApiVerificationController::class, 'AddverificationVocablary'])->name("store-voucab-verification");
    //Voucab ,
    Route::post("store-verification", [\App\Http\Controllers\API\ApiVerificationController::class, 'store'])-> name("store-verification");
    //Verification Entity Routes
    Route::post("add-vocabulary-entity", [\App\Http\Controllers\Adult\VerificationController::class, 'addVocabularyEntity'])->name("add-vocabulary-entity");
    Route::post("delete-vocabulary", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteVocabulary'])-> name("delete-vocabulary");
    Route::post("store-validations", [\App\Http\Controllers\API\ApiVerificationController::class, 'StoreValidatoins'])->name("store-validations");
    Route::post("add-problem-development", [\App\Http\Controllers\Adult\VerificationController::class, 'storeProblemDevelopmnt'])-> name("add-problem-development");
    Route::post("del-problem-development", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteProblemDevelopmnt'])-> name("del-problem-development");
    //Error Correction Aproach
    Route::post("create-error-correction-type", [\App\Http\Controllers\Adult\VerificationController::class, 'addErrorCorectionAproach'])->name("create-error-correction-type");
    Route::get("feedback-identification", [\App\Http\Controllers\Adult\VerificationController::class, 'feedbackIdentification'])-> name("feedback-identification");
    Route::post("store-feedback-identification", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFeedbackIdentification'])-> name("store-feedback-identification");
    Route::post("delete-feedback-identification/{id}", [\App\Http\Controllers\Adult\VerificationController::class, 'DeleteFeedbackIdentification'])->name("delete-feedback-identification");
    Route::get("error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'errorCorrection'])-> name("error-correction");
    Route::post("store-error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'storeErrorCorrection'])-> name("store-error-correction");
    Route::post("delete-error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteErrorCorrection'])-> name("delete-error-correction");

    //function Adjustments
        Route::post("store-function-adjustment", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFunctionAdjustment'])-> name("store-function-adjustment");
        Route::post("function-sub-and-people", [\App\Http\Controllers\Adult\VerificationController::class, 'functionSustitutionAndPeople'])-> name("function-sub-and-people");
        Route::post("sol-fun-av", [\App\Http\Controllers\Adult\VerificationController::class, 'SolutionFunctionAverage'])-> name("sol-fun-av");
        Route::post("update-solution-part", [\App\Http\Controllers\Adult\VerificationController::class, 'UpdateSolutionFunctionAverage'])-> name("update-solution-part");

        Route::post("store-sep-steps", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreCommonVerifications'])->name("store-sep-steps");
        Route::post("before-after", [\App\Http\Controllers\Adult\VerificationController::class, 'BeforeAndAfter'])-> name("before-after");
        Route::post("delete-before-after", [\App\Http\Controllers\Adult\VerificationController::class, 'DeleteBeforeAndAfter'])-> name("delete-before-after");
        Route::post("store-time-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'storeTimeVerification'])->name("store-time-verification");

        Route::post("delete-time-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteTimeVerification'])-> name("delete-time-verification");
       //Past and present time
       Route::post("store-past-present-time", [\App\Http\Controllers\Adult\VerificationController::class, 'StorePastPresentTime'])->name("store-past-present-time");
       Route::post("delete-past-present-time", [\App\Http\Controllers\Adult\VerificationController::class, 'APIDeletePastPresentTime'])->name("delete-past-present-time");
       //	Replace Problem by Problem
       Route::post("replace-problem-by-problem", [\App\Http\Controllers\Adult\VerificationController::class, 'replaceProblemByProblem'])-> name("replace-problem-by-problem");
        //Project Usres
       Route::get("users", [\App\Http\Controllers\Adult\UserController::class, 'index'])-> name("users");
       Route::post("create-user", [\App\Http\Controllers\Adult\UserController::class, 'create'])-> name("create-user");
       Route::post("delete-user", [\App\Http\Controllers\Adult\VerificationController::class, 'deletePeopleFromProject'])-> name("delete-user");
       //partition approach
       Route::post("add-entity-word", [\App\Http\Controllers\Adult\VerificationController::class, 'createPartitionApproach'])-> name("add-entity-word");
       Route::post("update_validations", [\App\Http\Controllers\Adult\VerificationController::class, 'updateValidations'])-> name("update_validations");
       Route::post("communication_flow", [\App\Http\Controllers\Adult\VerificationController::class, 'storeCommunicationFlow'])-> name("communication_flow");
       Route::post("del-communication_flow", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteCommunicationFlow'])-> name("del-communication_flow");
       Route::get("me-and-you-next/{id}", [\App\Http\Controllers\Adult\VerificationController::class, 'MeVsYouNextPage'])->name("me-and-you-next");
        Route::post("me-and-you-next-store", [\App\Http\Controllers\Adult\VerificationController::class, 'MeVsYouNextPageStore'])->name("me-and-you-next-store");
        Route::post("entity-usage", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreEntityUsage'])->name("entity-usage");
        //Outside from project
        Route::post("create-people-ouside-project", [\App\Http\Controllers\Adult\VerificationController::class, 'storePeopleOutSideFromProject'])-> name("create-people-ouside-project");
        Route::post("delete-people", [\App\Http\Controllers\Adult\VerificationController::class, 'deletePeopleOutSideProject'])-> name("delete-people");

        Route::post("mother-nature", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreMotherNature'])->name("mother-nature");
        Route::post("me-and-you", [\App\Http\Controllers\Adult\VerificationController::class, 'StorMeVsYou'])->name("me-and-you");
        Route::post("taking-advantage", [\App\Http\Controllers\Adult\VerificationController::class, 'StorTakingAdvantage'])->name("taking-advantage");

        Route::post("visibility_entity_behind_explanation", [\App\Http\Controllers\Adult\VerificationController::class, 'storeVisibilityEntityBehindExplanation'])-> name("visibility_entity_behind_explanation");
        Route::post("del_visibility_entity_behind_explanation", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteVisibilityEntityBehindExplanation'])-> name("del_visibility_entity_behind_explanation");
        Route::post("taking-advantage", [\App\Http\Controllers\Adult\VerificationController::class, 'StorTakingAdvantage'])->name("taking-advantage");
        Route::post("probelm-at-location", [\App\Http\Controllers\Adult\VerificationController::class, 'storeProblemAtLocation'])-> name("probelm-at-location");
        Route::post("function-at-location", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFunctionAtLocation'])-> name("function-at-location");
        // Passive Voice
        Route::post("passive-voice", [\App\Http\Controllers\Adult\VerificationController::class, 'storePassiveVoice'])-> name("passive-voice");
});





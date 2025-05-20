<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adult\ProjectController as AdultProjectController;
use App\Http\Controllers\Adult\VerificationController as AdultVerificationController;
use App\Http\Controllers\Adult\VerificationTypeController as AdultVerificationTypeController;
use App\Http\Controllers\Adult\VerificationTypeTextController as AdultVerificationTypeTextController;
use App\Http\Controllers\Adult\SolutionFunctionController as AdultSolutionFunctionController;
use App\Http\Controllers\Adult\SolutionTypeController as AdultSolutionTypeController;
use App\Http\Controllers\Adult\SolutionFuntionTypeController as AdultSolutionFuntionTypeController;
use App\Http\Controllers\Adult\UserController as AdultUserController;
use App\Http\Controllers\Adult\LoginController as AdultLoginController;
use App\Http\Controllers\Adult\ProblemController as AdultProblemController;
use App\Http\Controllers\Adult\SolutionController as AdultSolutionController;
use App\Http\Controllers\Adult\RelationshipController as AdultRelationshipController;
use App\Http\Controllers\Adult\ProjectShareController as ProjectShareController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Super Admin Routes Start
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::get("index", [\App\Http\Controllers\Admin\ProjectController::class, 'index']) ->name("index");
    Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'postLogin'])->name('login');
    Route::get('/getlogout', [\App\Http\Controllers\Admin\LoginController::class, 'getlogout'])->name('getlogout');
        
    Route::group(['as' => 'permission.', 'prefix' => 'permission'], function () {
        Route::get("index", [\App\Http\Controllers\Admin\PermissionsController::class , 'index'])->name("index");
        Route::get('/create', [\App\Http\Controllers\Admin\PermissionsController::class , 'create'])->name('create');
        Route::get('/store', [\App\Http\Controllers\Admin\PermissionsController::class , 'store'])->name('store');
        Route::get('/show', [\App\Http\Controllers\Admin\PermissionsController::class , 'show'])->name('show');
        Route::get('/edit', [\App\Http\Controllers\Admin\PermissionsController::class , 'edit'])->name('edit');
        Route::get('/update', [\App\Http\Controllers\Admin\PermissionsController::class , 'update'])->name('update');
        Route::delete('/massDestroy', [\App\Http\Controllers\Admin\PermissionsController::class , 'massDestroy'])->name('mass_destroy');
        Route::delete('/destroy', [\App\Http\Controllers\Admin\PermissionsController::class , 'destroy'])->name('destroy');
    }); 
});


Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("/", [\App\Http\Controllers\Admin\UserController::class, 'adminUser'])->name('index'); 
        Route::get("view/{id}", [\App\Http\Controllers\Admin\UserController::class, 'view']) -> name("view");
        Route::get("edit/{id}", [\App\Http\Controllers\Admin\UserController::class, 'edit']) -> name("edit");
        Route::post("update/{id}", [\App\Http\Controllers\Admin\UserController::class, 'update'])->name("update");
        Route::post("updateInfo/{id}", [\App\Http\Controllers\Admin\UserController::class, 'updateUserPersonalInfo'])->name("updateInfo");
        Route::post("updateUserSocialInfo/{id}", [\App\Http\Controllers\Admin\UserController::class, 'updateUserSocialInfo'])->name("updateUserSocialInfo");
        Route::get("delete/{id}", [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name("delete");
        Route::post("store", [\App\Http\Controllers\Admin\UserController::class, 'store'])->name("store");
        Route::get("add", [\App\Http\Controllers\Admin\UserController::class, 'create'])->name("add");
    }); 
});

Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("/", [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name("index");
    });  
});
Route::group(['as' => 'project.', 'prefix' => 'project'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::post("/store", [\App\Http\Controllers\Admin\ProjectController::class, 'store'])->name("store");
    });  
});

Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("/", [\App\Http\Controllers\Admin\ProblemCategoryController::class, 'index'])->name('index');
        Route::post("/add", [\App\Http\Controllers\Admin\ProblemCategoryController::class, 'store'])->name('add');
        Route::get("/delete", [\App\Http\Controllers\Admin\ProblemCategoryController::class, 'destroy'])->name('delete');
    });  
});
// Super Admin Routes End

// Adult User Logins
Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
    Route::post('/login', [\App\Http\Controllers\Adult\LoginController::class, 'postLogin'])->name('login');
    Route::get('/login', [\App\Http\Controllers\Adult\LoginController::class, 'getLogin'])->name('login');    
    Route::get('/getlogout', [\App\Http\Controllers\Adult\LoginController::class, 'getlogout'])->name('getlogout');
});

// Admin Solution 
Route::group(['as' => 'solution.', 'prefix' => 'solution'], function () {
        Route::group(['middleware' => ['auth' , 'admin']], function () {
            Route::get("index", [\App\Http\Controllers\Admin\SolutionController::class, 'index'])->name('index');
            Route::post("update", [\App\Http\Controllers\Admin\SolutionController::class, 'update'])->name('update');
            Route::post("delete", [\App\Http\Controllers\Admin\SolutionController::class, "delete"])->name('delete');
    });
});

//error
///admin err
Route::get("adminErr", [\App\Http\Controllers\ErrController::class, 'adminErr']) -> name("adminErr");///adult err
Route::get("adultErr", [\App\Http\Controllers\ErrController::class, 'adultErr']) -> name("adultErr");///child err
Route::get("childErr", [\App\Http\Controllers\ErrController::class, 'childErr']) -> name("childErr");//admin

///problem

Route::group(['as' => 'problem.', 'prefix' => 'problem'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("index", [\App\Http\Controllers\Admin\ProblemController::class, 'index'])->name("index");        
        Route::post("upadte", [\App\Http\Controllers\Admin\ProblemController::class, 'update'])->name("update");
        Route::post("delete", [\App\Http\Controllers\Admin\ProblemController::class, "delete"])->name('delete');
    });

});
///solution type
Route::group(['as' => 'solution.', 'prefix' => 'solution'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
            Route::get("adminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'adminSolutionType']) -> name("adminSolutionType");
            Route::post("createAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'createAdminSolutionType'])->name('create');
            Route::get("getAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'getAdminSolutionType']) -> middleware("auth", "admin");
            Route::post("updateAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'updateAdminSolutionType']) -> middleware("auth", "admin");
            Route::post("delAminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'delAminSolutionType']) -> middleware("auth", "admin");
    });
});
///solution


///solution function
Route::get("adminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'adminSolFunction']) -> middleware("auth", "admin") -> name('adminSolFunction');
Route::get("getAdminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'getAdminSolFunction']) -> middleware("auth", "admin");
Route::post("updateAdminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'updateAdminSolFunction']) -> middleware("auth", "admin");
///verification type

Route::group(['as' => 'verificationtype.', 'prefix' => 'verificationtype'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("index", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'index'])->name("index");
        Route::post("store", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'store'])->name("store");
        Route::post("delete", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'delete'])->name("delete");
    });
});
///verification type text

Route::group(['as' => 'verificationtypetext.', 'prefix' => 'verificationtypetext'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
            Route::get("index", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'index'])-> name("index");
            Route::post("store", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'store'])->name("store");
    });
    Route::post("delete", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'delete'])->name("delete");
});

Route::group(['as' => 'solutionfunction.', 'prefix' => 'solutionfunction'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("index", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'index'])-> name("index");
    });
});    
//ADULT ROUTES------------------------------------------------------------------------------
Route::get("home", [\App\Http\Controllers\Adult\ProjectController::class, 'index']) ->name("home");
///home
Route::group(['as' => 'adult.', 'prefix' => 'adult'], function () {
    Route::group(['middleware' => ['auth' , 'adult']], function () {
        //Route Project
        Route::post("/store", [\App\Http\Controllers\Adult\ProjectController::class, 'store'])-> name("store");
        Route::post("/delete", [\App\Http\Controllers\Adult\ProjectController::class, 'destroy'])-> name("delete");
        Route::get("/shareusers/{id?}", [\App\Http\Controllers\Adult\ProjectController::class, 'getUsersForProjectSharing'])->name("shareusers");


        //Route Problem
        Route::get("/problem/{id?}", [\App\Http\Controllers\Adult\ProblemController::class, 'index'])-> name("problem");
        Route::post("/store-problem", [\App\Http\Controllers\Adult\ProblemController::class, 'store'])-> name("store-problem");
        Route::post("/delete-problem", [\App\Http\Controllers\Adult\ProblemController::class, 'delete'])-> name("delete-problem");
        Route::get('/dashboard', [\App\Http\Controllers\Adult\ProjectController::class, 'index'])->name('dashboard');
        Route::get('/problems', [\App\Http\Controllers\Adult\ProjectController::class, 'index'])->name('problems');
        Route::post('/validation', [\App\Http\Controllers\Adult\ProblemController::class, 'updateValidation'])->name('validation');
        Route::post('/upload-profile-pic', [\App\Http\Controllers\Adult\ProblemController::class, 'uploadProfilePic'])->name('upload-profile-pic');


        //Route Solution
        Route::get("/solution/{id?}", [\App\Http\Controllers\Adult\SolutionController::class, 'index'])-> name("solution");
        Route::post("/store-solution", [\App\Http\Controllers\Adult\SolutionController::class, 'store'])-> name("store-solution");
        Route::post("/delete-solution", [\App\Http\Controllers\Adult\SolutionController::class, 'delete'])-> name("delete-solution");
        Route::post('/sol-validation', [\App\Http\Controllers\Adult\SolutionController::class, 'updateValidation'])->name('sol-validation');
        Route::post('/update-solution', [\App\Http\Controllers\Adult\SolutionController::class, 'updateSolution'])->name('updateSolution');
       
        
        //Route Solution Function
        Route::get("/solution-func/{id?}", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'index'])-> name("solution-func");
        Route::post("/store-solution-func", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'store'])-> name("store-solution-func");
        Route::post("/update-solution-func", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'update'])-> name("update-solution-func");
        Route::post("/delete-solution-func", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'delete'])-> name("delete-solution-func");
        Route::post('/solution-func-validation', [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'updateValidation'])->name('solution-func-validation');

        // Verification type  
        Route::get("vfrindex", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'index'])->name("vfrindex");
        Route::post("vfrstore", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'store'])->name("vfrstore");
        Route::post("vfrdelete", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'delete'])->name("vfrdelete");
        // Verification type text
        Route::get("vrftindex", [\App\Http\Controllers\Adult\VerificationTypeTextController::class, 'index'])-> name("vrftindex");
        Route::post("vrftstore", [\App\Http\Controllers\Adult\VerificationTypeTextController::class, 'store'])->name("vrftstore");
        Route::post("vrftdelete", [\App\Http\Controllers\Adult\VerificationTypeTextController::class, 'delete'])->name("vrftdelete");
        // Solution Type
        Route::get("stindex", [\App\Http\Controllers\Adult\SolutionTypeController::class, 'index'])-> name("stindex");
        Route::post("ststore", [\App\Http\Controllers\Adult\SolutionTypeController::class, 'store'])->name("ststore");
        Route::post("stdelete", [\App\Http\Controllers\Adult\SolutionTypeController::class, 'delete'])->name("stdelete");
        // Solution function Type
        Route::get("sftindex", [\App\Http\Controllers\Adult\SolutionFuntionTypeController::class, 'index'])-> name("sftindex");
        Route::post("sftstore", [\App\Http\Controllers\Adult\SolutionFuntionTypeController::class, 'store'])->name("sftstore");
        Route::post("sftdelete", [\App\Http\Controllers\Adult\SolutionFuntionTypeController::class, 'delete'])->name("sftdelete");
        // vrification Type
        Route::get("varification/{id?}/{type?}/{user_id?}", [\App\Http\Controllers\Adult\VerificationController::class, 'index'])-> name("varification");
        Route::get("add-varification-type", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'verificationType'])-> name("add-varification-type");
        Route::post("store-verification-type", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'store'])->name("store-verification-type");
        
        // vrification 
        Route::post("store-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'store'])-> name("store-verification");
        Route::post("store-priciple-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'storePricipleVerification'])-> name("store-priciple-verification");
        Route::post("store-entity-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'storeEntityAvailable'])-> name("store-entity-verification");
        Route::post("delete-entity-available/{id}", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteEntityAvailable'])-> name("delete-entity-available");

        Route::post("store-priciple-identification", [\App\Http\Controllers\Adult\VerificationController::class, 'storePricipleIdentification'])-> name("store-priciple-identification");
        Route::post("store-time-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'storeTimeVerification'])->name("store-time-verification");
        Route::post("delete-time-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteTimeVerification'])-> name("delete-time-verification");
        Route::post("updateVerification", [\App\Http\Controllers\Adult\EditVerificationController::class, 'updateVerification'])-> name("updateVerification");
        Route::post("delete-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'delete'])-> name("delete-verification");
        //Past and present time
        Route::post("store-past-present-time", [\App\Http\Controllers\Adult\VerificationController::class, 'StorePastPresentTime'])->name("store-past-present-time");
        Route::post("delete-past-present-time", [\App\Http\Controllers\Adult\VerificationController::class, 'DeletePastPresentTime'])->name("delete-past-present-time");


        Route::post("create-entity", [\App\Http\Controllers\Adult\VerificationController::class, 'createEntity'])-> name("create-entity");
        Route::post("del-entity", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteEntity'])-> name("del-entity");


        Route::post("add-problem-development", [\App\Http\Controllers\Adult\VerificationController::class, 'storeProblemDevelopmnt'])-> name("add-problem-development");
        Route::post("del-problem-development", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteProblemDevelopmnt'])-> name("del-problem-development");
        //Verification Entity Routes
        Route::post("add-vocabulary-entity", [\App\Http\Controllers\Adult\VerificationController::class, 'addVocabularyEntity'])-> name("add-vocabulary-entity");
        Route::post("before-after", [\App\Http\Controllers\Adult\VerificationController::class, 'BeforeAndAfter'])-> name("before-after");
        Route::post("delete-before-after", [\App\Http\Controllers\Adult\VerificationController::class, 'DeleteBeforeAndAfter'])-> name("delete-before-after");
        Route::post("delete-vocabulary", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteVocabulary'])-> name("delete-vocabulary");
        Route::post("updateVocabulary", [\App\Http\Controllers\Adult\EditVerificationController::class, 'updateVocabulary'])-> name("updateVocabulary");
        Route::post("add-vocabulary-validations", [\App\Http\Controllers\Adult\VerificationController::class, 'addVocabularyValidations'])-> name("add-vocabulary-validations");
        //partition approach
        Route::post("add-entity-word", [\App\Http\Controllers\Adult\VerificationController::class, 'createPartitionApproach'])-> name("add-entity-word");
        Route::post("update_validations", [\App\Http\Controllers\Adult\VerificationController::class, 'updateValidations'])-> name("update_validations");
        Route::post("communication_flow", [\App\Http\Controllers\Adult\VerificationController::class, 'storeCommunicationFlow'])-> name("communication_flow");
        Route::post("del-communication_flow", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteCommunicationFlow'])-> name("del-communication_flow");

        //Project Usres
        Route::get("users", [\App\Http\Controllers\Adult\UserController::class, 'index'])-> name("users");
        Route::post("create-user", [\App\Http\Controllers\Adult\UserController::class, 'create'])-> name("create-user");
        Route::post("delete-user", [\App\Http\Controllers\Adult\VerificationController::class, 'deletePeopleFromProject'])-> name("delete-user");
        //Outside from project
        Route::post("create-people-ouside-project", [\App\Http\Controllers\Adult\VerificationController::class, 'storePeopleOutSideFromProject'])-> name("create-people-ouside-project");
        Route::post("delete-people", [\App\Http\Controllers\Adult\VerificationController::class, 'deletePeopleOutSideProject'])-> name("delete-people");
        //Error Correction Aproach
        Route::post("create-error-correction-type", [\App\Http\Controllers\Adult\VerificationController::class, 'addErrorCorectionAproach'])-> name("create-error-correction-type");
        Route::get("feedback-identification", [\App\Http\Controllers\Adult\VerificationController::class, 'feedbackIdentification'])-> name("feedback-identification");
        Route::post("store-feedback-identification", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFeedbackIdentification'])-> name("store-feedback-identification");
        Route::post("delete-feedback-identification/{id}", [\App\Http\Controllers\Adult\VerificationController::class, 'DeleteFeedbackIdentification'])-> name("delete-feedback-identification");
        Route::get("error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'errorCorrection'])-> name("error-correction");
        Route::post("store-error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'storeErrorCorrection'])-> name("store-error-correction");
        Route::post("delete-error-correction", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteErrorCorrection'])-> name("delete-error-correction");

        //function Adjustments
        Route::post("store-function-adjustment", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFunctionAdjustment'])-> name("store-function-adjustment");
        Route::post("function-sub-and-people", [\App\Http\Controllers\Adult\VerificationController::class, 'functionSustitutionAndPeople'])-> name("function-sub-and-people");
        Route::post("sol-fun-av", [\App\Http\Controllers\Adult\VerificationController::class, 'SolutionFunctionAverage'])-> name("sol-fun-av");
        Route::post("update-solution-part", [\App\Http\Controllers\Adult\VerificationController::class, 'UpdateSolutionFunctionAverage'])-> name("update-solution-part");
        //	Replace Problem by Problem
        Route::post("replace-problem-by-problem", [\App\Http\Controllers\Adult\VerificationController::class, 'replaceProblemByProblem'])-> name("replace-problem-by-problem");
        // Passive Voice
        Route::post("passive-voice", [\App\Http\Controllers\Adult\VerificationController::class, 'storePassiveVoice'])-> name("passive-voice");
        // Passive Voice
        Route::post("resource-managment", [\App\Http\Controllers\Adult\VerificationController::class, 'storeResourceManagment'])-> name("resource-managment");
        Route::post("probelm-at-location", [\App\Http\Controllers\Adult\VerificationController::class, 'storeProblemAtLocation'])-> name("probelm-at-location");
        Route::post("function-at-location", [\App\Http\Controllers\Adult\VerificationController::class, 'storeFunctionAtLocation'])-> name("function-at-location");
        //visibility_entity_behind_explanation deleteVisibilityEntityBehindExplanation
 
        Route::post("visibility_entity_behind_explanation", [\App\Http\Controllers\Adult\VerificationController::class, 'storeVisibilityEntityBehindExplanation'])-> name("visibility_entity_behind_explanation");
        Route::post("del_visibility_entity_behind_explanation", [\App\Http\Controllers\Adult\VerificationController::class, 'deleteVisibilityEntityBehindExplanation'])-> name("del_visibility_entity_behind_explanation");
        Route::post("mother-nature", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreMotherNature'])->name("mother-nature");
        Route::post("me-and-you", [\App\Http\Controllers\Adult\VerificationController::class, 'StorMeVsYou'])->name("me-and-you");
        Route::post("taking-advantage", [\App\Http\Controllers\Adult\VerificationController::class, 'StorTakingAdvantage'])->name("taking-advantage");

        Route::post("store-sep-steps", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreCommonVerifications'])->name("store-sep-steps");
        Route::get("me-and-you-next/{id}", [\App\Http\Controllers\Adult\VerificationController::class, 'MeVsYouNextPage'])->name("me-and-you-next");
        Route::post("me-and-you-next-store", [\App\Http\Controllers\Adult\VerificationController::class, 'MeVsYouNextPageStore'])->name("me-and-you-next-store");
        Route::post("entity-usage", [\App\Http\Controllers\Adult\VerificationController::class, 'StoreEntityUsage'])->name("entity-usage");



        //RelationShip Controller

        Route::get("rel/{id?}/{type?}", [\App\Http\Controllers\Adult\RelationshipController::class, 'index'])->name("rel");
        Route::post("save-rel-validations", [\App\Http\Controllers\Adult\RelationshipController::class, 'SaveValidations'])->name("save-rel-validations");
        //Share project Routs
        Route::post("share-project", [\App\Http\Controllers\Adult\ProjectController::class, 'shareProject'])->name("share-project");
        Route::post("stop-share-project", [\App\Http\Controllers\Adult\ProjectController::class, 'StopshareProject'])->name("stop-share-project");
        Route::get("/share-project/{id}", [\App\Http\Controllers\Adult\ProjectController::class, 'shareProjectGet'])->name("project-share");
        Route::get("/permissions/{user_id}/{project_id}", [\App\Http\Controllers\Adult\ProjectController::class, 'viewPermissions'])->name("project_permissions");

    });  
});
Route::get("/quiz/{id}", [\App\Http\Controllers\QuizController::class, 'index'])->name("quiz");
Route::get("/add-quiz/{id}", [\App\Http\Controllers\QuizController::class, 'addQuiz'])-> name("add-quiz");
Route::post("/store-quiz", [\App\Http\Controllers\QuizController::class, 'store'])-> name("store-quiz");
Route::get("/edit-quiz/{id}", [\App\Http\Controllers\QuizController::class, 'edit'])-> name("edit-quiz");
Route::post("/update-quiz/{id}", [\App\Http\Controllers\QuizController::class, 'update'])-> name("update-quiz");
Route::delete("/delete-quiz/{id}", [\App\Http\Controllers\QuizController::class, 'destroy'])-> name("delete-quiz");

Route::post("add-quiz-data", [\App\Http\Controllers\QuizController::class, 'saveQuizData'])-> name("add-quiz-data");
Route::post('/get-quiz', [QuizController::class, 'getQuiz'])->name('get-quiz');


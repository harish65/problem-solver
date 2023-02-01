<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'getLogin'])->name('login');
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
        Route::get("view/{id}", [\App\Http\Controllers\Admin\UserController::class, 'view']) -> name("view");
        Route::get("edit/{id}", [\App\Http\Controllers\Admin\UserController::class, 'edit']) -> name("edit");
        Route::post("update/{id}", [\App\Http\Controllers\Admin\UserController::class, 'update'])->name("update");
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
// Super Admin Routes End

// User Logins
Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
    Route::post('/login', [\App\Http\Controllers\Adult\LoginController::class, 'postLogin'])->name('login');
    Route::get('/login', [\App\Http\Controllers\Adult\LoginController::class, 'getLogin'])->name('login');
    Route::get('/dashborad', [\App\Http\Controllers\Adult\ProblemController::class, 'adultProblem'])->name('dashborad');
    Route::get('/getlogout', [\App\Http\Controllers\Adult\LoginController::class, 'getlogout'])->name('getlogout');
});
// Admin Solution 
Route::group(['as' => 'adminSolution.', 'prefix' => 'adminSolution'], function () {
        Route::group(['middleware' => ['auth' , 'admin']], function () {
            Route::get("index", [\App\Http\Controllers\Admin\SolutionController::class, 'index'])->name('index');
            // Route::get("getAdminSolution", [\App\Http\Controllers\Admin\SolutionController::class, "getAdminSolution"])->name('adminSolutions');
            Route::post("update", [\App\Http\Controllers\Admin\SolutionController::class, 'update'])->name('update');
            Route::post("delAdminSolution", [\App\Http\Controllers\Admin\SolutionController::class, "delAdminSolution"]);
    });
});
///Roles and permissions Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("profile", [\App\Http\Controllers\ProfileController::class, 'profile']) -> name("profile") -> middleware("auth");
Route::post("updateProfile", [\App\Http\Controllers\ProfileController::class, 'updateProfile']) -> middleware("auth");

//error
///admin err
Route::get("adminErr", [\App\Http\Controllers\ErrController::class, 'adminErr']) -> name("adminErr");///adult err
Route::get("adultErr", [\App\Http\Controllers\ErrController::class, 'adultErr']) -> name("adultErr");///child err
Route::get("childErr", [\App\Http\Controllers\ErrController::class, 'childErr']) -> name("childErr");//admin
///home
// Route::get("adminHome", [\App\Http\Controllers\Admin\HomeController::class, 'adminHome']) -> middleware("auth", "admin") -> name("adminHome");

///user
Route::get("adminUser", [\App\Http\Controllers\Admin\UserController::class, 'adminUser']) -> middleware("auth", "admin") -> name("adminUser");
Route::get("getAdminUser", [\App\Http\Controllers\Admin\UserController::class, 'getAdminUser']) -> middleware("auth", "admin");



Route::post("delAdminUser", [\App\Http\Controllers\Admin\UserController::class, 'delAdminUser']) -> middleware("auth", "admin");
///problem
Route::get("adminProblem", [\App\Http\Controllers\Admin\ProblemController::class, 'adminProblem']) -> middleware("auth", "admin") -> name("adminProblem");
Route::get("getAdminProblem", [\App\Http\Controllers\Admin\ProblemController::class, 'getAdminProblem']) -> middleware("auth", "admin");
Route::post("updateAdminProblem", [\App\Http\Controllers\Admin\ProblemController::class, 'update']) -> middleware("auth", "admin")->name("updateAdminProblem");
Route::post("delAdminProblem", [\App\Http\Controllers\Admin\ProblemController::class, "delAdminProblem"]) -> middleware("auth", "admin")->name('delAdminProblem');

///solution type
Route::get("adminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'adminSolutionType']) -> middleware("auth", "admin") -> name("adminSolutionType");
Route::post("createAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'createAdminSolutionType']) -> middleware("auth", "admin");
Route::get("getAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'getAdminSolutionType']) -> middleware("auth", "admin");
Route::post("updateAdminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'updateAdminSolutionType']) -> middleware("auth", "admin");
Route::post("delAminSolutionType", [\App\Http\Controllers\Admin\SolutionTypeController::class, 'delAminSolutionType']) -> middleware("auth", "admin");

///solution


///solution function
Route::get("adminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'adminSolFunction']) -> middleware("auth", "admin") -> name('adminSolFunction');
Route::get("getAdminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'getAdminSolFunction']) -> middleware("auth", "admin");
Route::post("updateAdminSolFunction", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'updateAdminSolFunction']) -> middleware("auth", "admin");
///verification type
Route::get("adminVerificationType", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'adminVerificationType']) -> middleware("auth", "admin") -> name("adminVerificationType");
Route::get("getAdminVerificationType", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'getAdminVerificationType']) -> middleware("auth", "admin");
Route::post("createAdminVerificationType", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'createAdminVerificationType']) -> middleware("auth", "admin");
Route::post("updateAdminVerificationType", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'updateAdminVerificationType']) -> middleware("auth", "admin");
Route::post("delAminVerificationType", [\App\Http\Controllers\Admin\VerificationTypeController::class, 'delAminVerificationType']) -> middleware("auth", "admin");

///verification type text
Route::get("adminVerificationTypeText", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'adminVerificationTypeText']) -> middleware("auth", "admin")-> name("adminVerificationTypeText");
Route::post("createAdminVerificationTypeText", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'createAdminVerificationTypeText']) -> middleware("auth", "admin");
Route::get("getAdminVerificationTypeText", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'getAdminVerificationTypeText']) -> middleware("auth", "admin");
Route::post("updateAdminVerificationTypeText", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'updateAdminVerificationTypeText']) -> middleware("auth", "admin");
Route::post("delAminVerificationTypeText", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'delAminVerificationTypeText']) -> middleware("auth", "admin");

//adult
///home
Route::get("adultHome", [\App\Http\Controllers\Adult\HomeController::class, 'adultHome']) -> middleware("auth", "adult") -> name("adultProblem");

////problem
Route::get("adultProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'adultProblem']) -> middleware("auth", "adult") -> name("adultProblem");
Route::post("createProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'createProblem']) -> middleware("auth", "adult");
Route::post("updateProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'updateProblem']) -> middleware("auth", "adult");
Route::post("delProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'delProblem']) -> middleware("auth", "adult");

////solution
Route::get("adultSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'adultSolution']) -> middleware("auth", "adult") -> name("adultSolution");
Route::post("createSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'createSolution']) -> middleware("auth", "adult");
Route::post("updateSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'updateSolution']) -> middleware("auth", "adult");
Route::post("delSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'delSolution']) -> middleware("auth", "adult");

////solution function
Route::get("adultSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'adultSolFunction']) -> middleware("auth", "adult") -> name("adultSolFunction");
Route::get("getSolutionPerProblem", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'getSolutionPerProblem']) -> middleware("auth", "adult");
Route::post("createSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'createSolFunction']) -> middleware("auth", "adult");
Route::get("getSolutionPerProblemForUpdate", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'getSolutionPerProblemForUpdate']) -> middleware("auth", "adult");
Route::post("updateSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'updateSolFunction']) -> middleware("auth", "adult");
Route::post("delSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'delSolFunction']) -> middleware("auth", "adult");

////verification
Route::get("adultVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'adultVerification']) -> middleware("auth", "adult") -> name("adultVerification");
Route::post("createVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'createVerification']) -> middleware("auth", "adult");
Route::post("createVerificationByPlus", [\App\Http\Controllers\Adult\VerificationController::class, 'createVerificationByPlus']) -> middleware("auth", "adult");
Route::post("updateVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'updateVerification']) -> middleware("auth", "adult");
Route::post("delVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'delVerification']) -> middleware("auth", "adult");
Route::post("delVerifications", [\App\Http\Controllers\Adult\VerificationController::class, 'delVerifications']) -> middleware("auth", "adult");
Route::get("getSolFunctionPerProblem", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolFunctionPerProblem']) -> middleware("auth", "adult");
Route::get("getSolFunctionPerSolution", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolFunctionPerSolution']) -> middleware("auth", "adult");
Route::post("updateVerificationType", [\App\Http\Controllers\Adult\VerificationController::class, "updateVerificationType"]) -> middleware("auth", "adult");
Route::get("getProblemPerSolFunction", [\App\Http\Controllers\Adult\VerificationController::class, 'getProblemPerSolFunction']) -> middleware("auth", "adult");
Route::get("getSolutionPerSolFunction", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolutionPerSolFunction']) -> middleware("auth", "adult");
Route::get("getVerificationTypeTextPerType", [\App\Http\Controllers\Adult\VerificationController::class, 'getVerificationTypeTextPerType']) -> middleware("auth", "adult");
Route::post('updateVerifications', [\App\Http\Controllers\Adult\VerificationController::class, 'updateVerifications']) -> middleware("auth", "adult");

///about

///share

///quiz

///setting
Route::get("adultSetting", [\App\Http\Controllers\Adult\SettingController::class, 'adultSetting']) -> middleware("auth", "adult") -> name("adultSetting");

Route::get("settingAdminSingleSoultin", [\App\Http\Controllers\Adult\SettingController::class, 'settingAdminSingleSoultin']) -> middleware("auth", "adult");

//child
///home
Route::get("childHome", [\App\Http\Controllers\Child\HomeController::class, 'childHome']) -> middleware('auth', 'child') -> name("childHome");

Route::get("project", [\App\Http\Controllers\Project\ProjectController::class, 'index']) -> middleware('auth') -> name("project");
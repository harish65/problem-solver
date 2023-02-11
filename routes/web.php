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
    Route::get('/dashborad', [\App\Http\Controllers\Adult\ProjectController::class, 'index'])->name('dashborad')-> middleware("auth", "adult");;
    Route::get('/getlogout', [\App\Http\Controllers\Adult\LoginController::class, 'getlogout'])->name('getlogout');
});
// Admin Solution 
Route::group(['as' => 'solution.', 'prefix' => 'solution'], function () {
        Route::group(['middleware' => ['auth' , 'admin']], function () {
            Route::get("index", [\App\Http\Controllers\Admin\SolutionController::class, 'index'])->name('index');
            // Route::get("getAdminSolution", [\App\Http\Controllers\Admin\SolutionController::class, "getAdminSolution"])->name('adminSolutions');
            Route::post("update", [\App\Http\Controllers\Admin\SolutionController::class, 'update'])->name('update');
            Route::post("delete", [\App\Http\Controllers\Admin\SolutionController::class, "delete"])->name('delete');
    });
});
///Roles and permissions Routes
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get("profile", [\App\Http\Controllers\ProfileController::class, 'profile']) -> name("profile") -> middleware("auth");
// Route::post("updateProfile", [\App\Http\Controllers\ProfileController::class, 'updateProfile']) -> middleware("auth");

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
    });Route::post("delete", [\App\Http\Controllers\Admin\VerificationTypeTextController::class, 'delete'])->name("delete");
});

Route::group(['as' => 'solutionfunction.', 'prefix' => 'solutionfunction'], function () {
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("index", [\App\Http\Controllers\Admin\SolutionFunctionController::class, 'index'])-> name("index");
    });
});    
//adult
///home
Route::group(['as' => 'project.', 'prefix' => 'project'], function () {
    Route::group(['middleware' => ['auth' , 'adult']], function () {
        Route::get("/store", [\App\Http\Controllers\Adult\ProjectController::class, 'store'])-> name("store");
    });
});    




// Route::get("adultHome", [\App\Http\Controllers\Adult\HomeController::class, 'adultHome']) -> middleware("auth", "adult") -> name("adultProblem");

// ////problem
// Route::get("adultProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'adultProblem']) -> middleware("auth", "adult") -> name("adultProblem");
// Route::post("createProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'createProblem']) -> middleware("auth", "adult");
// Route::post("updateProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'updateProblem']) -> middleware("auth", "adult");
// Route::post("delProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'delProblem']) -> middleware("auth", "adult");

// ////solution
// Route::get("adultSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'adultSolution']) -> middleware("auth", "adult") -> name("adultSolution");
// Route::post("createSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'createSolution']) -> middleware("auth", "adult");
// Route::post("updateSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'updateSolution']) -> middleware("auth", "adult");
// Route::post("delSolution", [\App\Http\Controllers\Adult\SolutionController::class, 'delSolution']) -> middleware("auth", "adult");

// ////solution function
// Route::get("adultSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'adultSolFunction']) -> middleware("auth", "adult") -> name("adultSolFunction");
// Route::get("getSolutionPerProblem", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'getSolutionPerProblem']) -> middleware("auth", "adult");
// Route::post("createSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'createSolFunction']) -> middleware("auth", "adult");
// Route::get("getSolutionPerProblemForUpdate", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'getSolutionPerProblemForUpdate']) -> middleware("auth", "adult");
// Route::post("updateSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'updateSolFunction']) -> middleware("auth", "adult");
// Route::post("delSolFunction", [\App\Http\Controllers\Adult\SolutionFunctionController::class, 'delSolFunction']) -> middleware("auth", "adult");

// ////verification
// Route::get("adultVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'adultVerification']) -> middleware("auth", "adult") -> name("adultVerification");
// Route::post("createVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'createVerification']) -> middleware("auth", "adult");
// Route::post("createVerificationByPlus", [\App\Http\Controllers\Adult\VerificationController::class, 'createVerificationByPlus']) -> middleware("auth", "adult");
// Route::post("updateVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'updateVerification']) -> middleware("auth", "adult");
// Route::post("delVerification", [\App\Http\Controllers\Adult\VerificationController::class, 'delVerification']) -> middleware("auth", "adult");
// Route::post("delVerifications", [\App\Http\Controllers\Adult\VerificationController::class, 'delVerifications']) -> middleware("auth", "adult");
// Route::get("getSolFunctionPerProblem", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolFunctionPerProblem']) -> middleware("auth", "adult");
// Route::get("getSolFunctionPerSolution", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolFunctionPerSolution']) -> middleware("auth", "adult");
// Route::post("updateVerificationType", [\App\Http\Controllers\Adult\VerificationController::class, "updateVerificationType"]) -> middleware("auth", "adult");
// Route::get("getProblemPerSolFunction", [\App\Http\Controllers\Adult\VerificationController::class, 'getProblemPerSolFunction']) -> middleware("auth", "adult");
// Route::get("getSolutionPerSolFunction", [\App\Http\Controllers\Adult\VerificationController::class, 'getSolutionPerSolFunction']) -> middleware("auth", "adult");
// Route::get("getVerificationTypeTextPerType", [\App\Http\Controllers\Adult\VerificationController::class, 'getVerificationTypeTextPerType']) -> middleware("auth", "adult");
// Route::post('updateVerifications', [\App\Http\Controllers\Adult\VerificationController::class, 'updateVerifications']) -> middleware("auth", "adult");

// ///about

// ///share

// ///quiz

// ///setting
// Route::get("adultSetting", [\App\Http\Controllers\Adult\SettingController::class, 'adultSetting']) -> middleware("auth", "adult") -> name("adultSetting");

// Route::get("settingAdminSingleSoultin", [\App\Http\Controllers\Adult\SettingController::class, 'settingAdminSingleSoultin']) -> middleware("auth", "adult");

// //child
// ///home
// Route::get("childHome", [\App\Http\Controllers\Child\HomeController::class, 'childHome']) -> middleware('auth', 'child') -> name("childHome");

// Route::get("project", [\App\Http\Controllers\Project\ProjectController::class, 'index']) -> middleware('auth') -> name("project");
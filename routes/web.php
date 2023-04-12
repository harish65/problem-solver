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
        Route::get("varification/{id?}/{type?}", [\App\Http\Controllers\Adult\VerificationController::class, 'index'])-> name("varification");
        Route::get("add-varification-type", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'verificationType'])-> name("add-varification-type");
        Route::post("store-verification-type", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'store'])->name("store-verification-type");
        Route::get("edit-verification-type/{id}", [\App\Http\Controllers\Adult\VerificationTypeController::class, 'edit'])->name("edit-verification-type");
        // vrification 
        Route::post("store-verification", [\App\Http\Controllers\Adult\VerificationController::class, 'store'])-> name("store-verification");

    });  
});

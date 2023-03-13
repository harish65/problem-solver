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


});





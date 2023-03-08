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

    // Probelm Routes
    Route::get("/problem", [\App\Http\Controllers\API\ApiController::class, 'getProblem'])-> name("problem");
    Route::post("/store-problem", [\App\Http\Controllers\API\ApiController::class, 'storeProblem'])-> name("store-problem");
    Route::post("/delete-problem", [\App\Http\Controllers\API\ApiController::class, 'deleteProblem'])-> name("delete-problem");
    // Route::post('/validation', [\App\Http\Controllers\Adult\ProblemController::class, 'updateValidation'])->name('validation');
    //User profile pic API
    Route::post('/upload-profile-pic', [\App\Http\Controllers\API\ApiController::class, 'uploadProfilePic'])->name('upload-profile-pic');

});





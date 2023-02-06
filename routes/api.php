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


Route::get('/dashborad', [\App\Http\Controllers\Adult\ProblemController::class, 'adultProblem'])->name('dashborad');
Route::get('/getlogout', [\App\Http\Controllers\Adult\LoginController::class, 'getlogout'])->name('getlogout');
Route::get("adultProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'adultProblem']) -> middleware("auth", "adult") -> name("adultProblem");
Route::post("createProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'createProblem']) -> middleware("auth", "adult");
Route::post("updateProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'updateProblem']) -> middleware("auth", "adult");
Route::post("delProblem", [\App\Http\Controllers\Adult\ProblemController::class, 'delProblem']) -> middleware("auth", "adult");


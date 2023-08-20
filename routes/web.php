<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class,'index']);
Route::post('/add-task', [TaskController::class,'store']);
Route::post('/update-task', [TaskController::class,'update']);
Route::get('/delete-task', [TaskController::class,'delete']);

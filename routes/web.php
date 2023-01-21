<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PDFController;
use App\Http\Middleware\validate_login;

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
Route::get('/', [LoginController::class, 'home']);
Route::get('/post-graph', [AlumniController::class, 'get_grafik_data']);
Route::get('/persebaran', [AlumniController::class, 'persebaran']);
Route::get('/post-maps', [AlumniController::class, 'get_maps']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'post_login']);

Route::middleware([validate_login::class])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/beranda', function () { return view('home.beranda');});
    Route::get('/persebaran-data', function() { return view('home.persebaran');});
    Route::resource("/akun", UserController::class);
    Route::resource("/data", AlumniController::class);
    Route::get('/generate-pdf', [PDFController::class, 'generate_pdf']);
    Route::post('/import', [AlumniController::class, 'import']);

    Route::get('/kuisioner/broadcast', [KuisionerController::class, 'broadcast']);
    Route::get('/kuisioner/question', [KuisionerController::class, 'question']);
    Route::resource("/kuisioner", KuisionerController::class);
    
    Route::resource('/question', QuestionController::class);
    Route::resource('/answer', AnswerController::class);
});

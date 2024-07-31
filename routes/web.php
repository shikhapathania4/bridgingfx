<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\AdminController;

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
    return view('contact-us');
});
Route::post('/contact-us', [ContactUsController::class, 'index']);


Auth::routes();


Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout']);
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/submissions/view/{id}', [AdminController::class, 'viewSubmission']);
    Route::post('/admin/submissions/feedback', [AdminController::class, 'sendEmail']);
    Route::get('/admin/submissions/export', [AdminController::class, 'export']);
});

<?php

use App\Http\Controllers\AddParticipantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BgmiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FCController;
use App\Http\Controllers\FreeFireController;
use App\Http\Controllers\WebController;
use App\Http\Middleware\OnlineStatusMiddleware;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::post('/register', [DashboardController::class, 'store']);


Route::middleware([OnlineStatusMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/add', [AddParticipantController::class, 'index']);
    Route::post('/submit', [AddParticipantController::class, 'submit']);
    Route::get('/bgmi_duo', [BgmiController::class, 'duo']);
    Route::get('/bgmi_solo', [BgmiController::class, 'solo']);
    Route::get('/freefire_team', [FreeFireController::class, 'team']);
    Route::get('/freefire_duo', [FreeFireController::class, 'duo']);
    Route::get('/freefire_solo', [FreeFireController::class, 'solo']);
    Route::get('/fcmobile', [FCController::class, 'solo']);
    Route::get('/admincreate', [AdminController::class, 'form']);
    Route::post('/adminsubmit', [AdminController::class, 'submit']);
    Route::get('/user_update/{id}/{status}', [AdminController::class, 'updatestatus']);
    Route::get('/web', [WebController::class, 'index']);
    Route::post('/game-registration/{id}/verify', [DashboardController::class, 'verify'])
        ->name('game-registration.verify');
});





Route::get('/session', function () {
    echo "<pre>";
    print_r(session()->all());
});

Route::get('/logout', function () {
    Admin::where('id', session('id'))->update(['online' => 0]);
    session()->flush();
    return redirect('/admin');
});
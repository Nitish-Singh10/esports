<?php

use App\Http\Controllers\AddParticipantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BgmiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FCController;
use App\Http\Controllers\FreeFireController;
use App\Models\BgmiTeam;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('home');
});

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


Route::get('/session', function () {
    echo "<pre>";
    print_r(session()->all());
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/admin');
});
<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'filter'])->name('cars.items');
Route::get('/cars/{car}', [CarController::class, 'show']);
Route::post('/sendForm', [FormController::class, 'submit']);
Route::get('/policy', [FormController::class, 'policy']);
Route::get('/system/cache/clear', function (Request $request) {
    if ($request->get('isAdmin') === '98161fcf-8ead-4292-829d-f55470361307') {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return response()->json(['ok']);
    }
});
Route::get('/system/artisan/migrate', function (Request $request) {
    if ($request->get('isAdmin') === '98161fcf-8ead-4292-829d-f55470361307') {
        Artisan::call('migrate');
        return response()->json(['ok']);
    }
});
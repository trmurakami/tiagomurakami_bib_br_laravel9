<?php

use App\Http\Controllers\LattestoBibtex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ThingController;
use App\Models\Software;

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
    return view('welcome');
});

Route::get('/apps', function () {
    return view('apps');
});

Route::get('/onlinemarceditor', function () {
    return view('apps.onlinemarceditor');
});

Route::get('/editoralephseq', function () {
    return view('apps.editoralephseq');
});

Route::get('/lattestobibtex', function () {
    return view('apps.lattestobibtex');
});
Route::post('/lattestobibtex', LattestoBibtex::class);

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/guiadesoftwares', [SoftwareController::class, 'guiadesoftwares']);

Route::resource('softwares', SoftwareController::class);

Route::get('/software/{id}', function (Software $id) {
    return view('softwares.software', compact('id'));
});


Route::resource('things', ThingController::class);

Route::post('/softwaretothing', [ThingController::class, 'addSoftwaretoThing']);
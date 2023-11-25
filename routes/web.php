<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LattestoBibtex;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ThingController;
use App\Models\Software;
use App\Http\Controllers\MARCQAController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorksAPIController;
use App\Http\Controllers\WorkThingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ClassificadorController;
use App\Http\Controllers\QualisController;
use App\Http\Controllers\AuroraSDG;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/apps', function () {
    return view('apps');
});

Route::get('/slides', function () {
    return view('slides');
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

Route::get('/guiadesoftwares', [SoftwareController::class, 'guiadesoftwares']);

Route::resource('softwares', SoftwareController::class);

Route::get('/software/{id}', function (Software $id) {
    return view('softwares.software', compact('id'));
});

Route::post('/softwaretothing', [ThingController::class, 'addSoftwaretoThing']);

Route::get('/cutter', function () {
    return view('cutter.cutter');
});

Route::get('/marc', function () {
    return view('marc.upload');
});

Route::post('marcqareport', [MARCQAController::class, 'marcQAReport'])->name('marc.report');


Route::resource('works', WorkController::class);
Route::resource('works', WorkController::class)->only(['create'])->middleware('auth');
Route::resource('works', WorkController::class)->only(['edit'])->middleware('auth');

Route::get('/editor', function () {
    return view('works.createnew');
})->middleware('auth');

Route::post('/works/{work}/attach', [WorkThingController::class, 'attachThing'])->name('works.attachThing');
Route::delete('/works/{work}/detach/{thing}', [WorkThingController::class, 'detachThing'])->name('works.detachThing');

Route::resource('things', ThingController::class);
Route::resource('abouts', AboutController::class);

Route::resource('qualis', QualisController::class);

Route::get('upload', [UploadController::class, 'index'])->middleware('auth');
Route::post('upload', [UploadController::class, 'upload'])->name('upload.upload');

Route::get('graficos', [WorkController::class, 'graficos'])->name('works.graficos');

Route::get('/classificador/consulta', [ClassificadorController::class, 'consulta'])->name('classificador.consulta');
Route::post('/classificador/consulta', [ClassificadorController::class, 'processarConsulta'])->name('classificador.processarConsulta');
Route::get('/classificador/treinamento', [ClassificadorController::class, 'treinamento'])->name('classificador.treinamento');
Route::post('/classificador/treinamento', [ClassificadorController::class, 'processarTreinamento'])->name('classificador.processarTreinamento');
Route::post('/classificador/uploadTSVTreinamento', [ClassificadorController::class, 'uploadTSVTreinamento']);

Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Route::get('/aurorasdg', function () {
    return view('apps.aurorasdg');
});
Route::post('/aurorasdg', AuroraSDG::class);
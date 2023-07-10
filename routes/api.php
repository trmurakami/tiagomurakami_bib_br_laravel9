<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Z3950Controller;
use App\Http\Controllers\CutterSanbornController;
use App\Http\Controllers\MARCQAController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('z3950', [Z3950Controller::class, 'searchZ3950']);

Route::get('cutter', [CutterSanbornController::class, 'cutter']);

Route::post('marcqa', [MARCQAController::class, 'marcQA']);
Route::post('marcqaexportfield', [MARCQAController::class, 'exportfield']);
Route::post('marcqareportTitleInd2', [MARCQAController::class, 'reportTitleInd2']);
Route::post('marcqacorrectTitleInd2', [MARCQAController::class, 'correctTitleInd2']);
<?php

use App\Actions\Generic\Lookup\ListManufactureAction;
use App\Actions\Generic\Lookup\ListModelAction;
use App\Actions\Generic\Settings\AppTypeVersionsAction;
use App\Actions\Generic\UploadAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('upload', UploadAction::class);

// Platform version
Route::get('versions', AppTypeVersionsAction::class);
Route::get('manufactures', ListManufactureAction::class);
Route::get('manufactures/{manufacture}/models', ListModelAction::class);

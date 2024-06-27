<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleSheetService;
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

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name("login");

Route::get('/periodictable', function () {
    $googleSheetService = new GoogleSheetService();
    $data = $googleSheetService->getDataSheets();
    return view('periodictable',['data'=>$data]);
})->middleware('auth');

Route::get("/signin", [AuthController::class,'signin']);
Route::get("/callback", [AuthController::class,'callback']);
Route::get("/data_sheet", [GoogleSheetService::class,'getDataSheets']);

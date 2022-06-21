<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//-----Contacts--------------------------------------------------------------------------------------------------------//
Route::group(['prefix' => 'contacts'], function () {
    Route::get('', [ContactsController::class, 'index']);
    Route::post('', [ContactsController::class, 'store']);
    Route::get('{contact}', [ContactsController::class, 'show']);
    Route::put('{contact}', [ContactsController::class, 'update']);
    Route::delete('{contact}', [ContactsController::class, 'destroy']);
});

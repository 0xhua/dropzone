<?php

use App\Http\Controllers\ItemController;
use App\Models\Item;
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

Route::post('/saveitem', [ItemController::class, 'saveItem']);
Route::post('/updateitem', [ItemController::class, 'updateItemDetails']);
Route::post('/claimItem', [ItemController::class, 'claimItem']);
Route::post('/releaseItemPayment', [ItemController::class, 'releaseItemPayment']);


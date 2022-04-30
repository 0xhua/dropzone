<?php

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
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


//Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::get('logout', [PassportAuthController::class, ',logout']);
Route::get('locations', function () {
    $locations = \App\Models\Location::all();
    return response()->json(
        [
            'location' => $locations
        ], 200);
});
Route::post('scanqr', [PassportAuthController::class, 'scanQr']);
Route::post('register', [PassportAuthController::class, 'register_seller']);
Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', [ItemController::class, 'dashboard']);
    Route::get('items', [ItemController::class, 'itemlist']);    //add-item
    Route::post('add-item', [ItemController::class, 'saveItem']);
    Route::get('itemrequest', [RequestController::class, 'seller_request']);    //add-item
    Route::post('add-request', [RequestController::class, 'store']);
    Route::get('settings', function () {
        $user = \App\Models\User::findorFail(auth()->id());
        return response()->json(
            [
                'user' => $user
            ], 200);
    });
    Route::post('update-setting', [UserController::class, 'update_settings']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::post('/saveitem', [ItemController::class, 'saveItem']);
//Route::post('/updateitem', [ItemController::class, 'updateItemDetails']);
//Route::post('/claimItem', [ItemController::class, 'claimItem']);
//Route::post('/releaseItemPayment', [ItemController::class, 'releaseItemPayment']);


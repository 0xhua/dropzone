<?php


use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CashoutController;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    if (auth()->user()) {
        return redirect('dashboard');
    }
    return view('home');
})->name('home');

Route::get('login', function () {
    return redirect()->to(route('home') . '#login');
})->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/scan', 'scan')->name('scan');
Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);


    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::get('dashboard', [ItemController::class, 'dashboard'])->name('dashboard');
    Route::get('itemlist', [ItemController::class, 'itemlist'])->name('itemlist');
    Route::get('seller_request', [RequestController::class, 'seller_request'])->name('seller_request');

    //tutorial
    Route::prefix('tutorial')->group(function () {
        Route::view('/1', 'tutorial.1')->name('tutor.1');
        Route::view('/2', 'tutorial.2')->name('tutor.2');
        Route::view('/3', 'tutorial.3')->name('tutor.3');
        Route::view('/4', 'tutorial.4')->name('tutor.4');
    });

    //updates
    Route::view('/updates', 'updates')->name('updates');

    //settings
    Route::view('/settings', 'setting')->name('settings');

    //add-item
    Route::post('add-item', [ItemController::class, 'saveItem'])->name('add-item');

    //Update Item Status
    Route::post('update-item-status', [ItemController::class, 'updateItemStatus'])->name('update-item-status');

    //approve-item
    Route::post('approve-item', [ItemController::class, 'approveItem'])->name('approve-item');

    //mark as paid item
    Route::post('paid-item', [ItemController::class, 'markAsPaid'])->name('paid-item');

    //claim item
    Route::post('claim-item', [ItemController::class, 'claimItem'])->name('claim-item');

    //release-item
    Route::post('release-item', [ItemController::class, 'rel'])->name('release-item');

    //pullout item
    Route::post('pullout-item', [ItemController::class, 'pullOut'])->name('pullout-item');

    //add-request
    Route::post('add-request', [RequestController::class,'store'])->name('add-request');


    //GENERATE QR FOR ITEM
    Route::get('item-generate-qr', [ItemController::class, 'generateItemQr']);

    //Download QR
    Route::post('downloadqr', [ItemController::class, 'downloadQr'])->name('downloadqr');

    //GET QR OF ITEM
    Route::get('test', [ItemController::class,'generateCode'])->name('test');

    //scanner
    Route::view('/scanner', 'scanner')->name('scanner');

    //scan item
    Route::post('scan-item', [ItemController::class,'scanItem'])->name('scan-item');

    //cashout-request
    Route::get('cashout', [CashoutController::class, 'index'])->name('cashout');



});

Route::post('/post', [ItemController::class, 'index']);


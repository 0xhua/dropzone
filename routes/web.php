<?php

//TODO
//USERMANAGEMANENT - done
//EDIT UPDATE ITEMS DONE
//USER update = email contact no DONE
//item update = buyer, destination amount payment DONE
//request update = category, request DONE
//SETTINGS DONE
//REGISTER done
use App\Http\Controllers\AnnouncementController;
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
    $locations = \App\Models\Location::all();
    return view('home', [
        'locations' => $locations
    ]);
})->name('home');
Route::view('/contact-us', 'contact')->name('contact-us');;
Route::view('/rules', 'rules')->name('rules');;
Route::view('/trasnfer-schedule', 'transfer')->name('trasnfer-schedule');;
Route::view('/branches', 'branches')->name('branches');;
Route::post('register', [UserController::class, 'register_seller'])->name('register');

Route::get('login', function () {
    return redirect()->to(route('home') . '#login');
})->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/scan', 'scan')->name('scan');
Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('user-list', [UserController::class, 'userList'])->name('user-list');
    Route::post('regiter-buyer', [UserController::class, 'register_buyer'])->name('register-buyer');
    Route::post('regiter-da', [UserController::class, 'register_da'])->name('register-da');
    Route::post('regiter-seller', [UserController::class, 'register_seller'])->name('register-seller');


    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::get('dashboard', [ItemController::class, 'dashboard'])->name('dashboard');
    Route::get('itemlist', [ItemController::class, 'itemlist'])->name('itemlist');
    Route::get('itemrequest', [RequestController::class, 'seller_request'])->name('itemrequest');

    //tutorial
    Route::prefix('tutorial')->group(function () {
        Route::view('/1', 'tutorial.1')->name('tutor.1');
        Route::view('/2', 'tutorial.2')->name('tutor.2');
        Route::view('/3', 'tutorial.3')->name('tutor.3');
        Route::view('/4', 'tutorial.4')->name('tutor.4');
    });

    //updates
    Route::get('updates',[AnnouncementController::class,'seller_updates'])->name('updates');

    //settings
//    Route::view('/settings', 'setting')->name('settings');

    Route::get('settings', function () {
        $user = \App\Models\User::findorFail(auth()->id());
        return view('setting', [
                'user' => $user
            ]
        );
    }
    )->name('settings');

    //add-item
    Route::post('add-item', [ItemController::class, 'saveItem'])->name('add-item');

    //Update-item-details
    Route::post('update-item', [ItemController::class, 'updateItemDetails'])->name('update-item');
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
    Route::post('add-request', [RequestController::class, 'store'])->name('add-request');

    //edit-request
    Route::post('edit-request', [RequestController::class, 'update_request'])->name('edit-request');
    //update-request-status
    Route::post('update-request-status', [RequestController::class, 'updateRequestStatus'])->name('update-request-status');


    //GENERATE QR FOR ITEM
    Route::get('item-generate-qr', [ItemController::class, 'generateItemQr']);

    //Download QR
    Route::post('downloadqr', [ItemController::class, 'downloadQr'])->name('downloadqr');

    //GET QR OF ITEM
    Route::get('test', [ItemController::class, 'generateCode'])->name('test');

    //scanner
    Route::view('/scanner', 'scanner')->name('scanner');

    //scan item
    Route::post('scan-item', [ItemController::class, 'scanItem'])->name('scan-item');

    //cashout-request
    Route::get('cashout', [CashoutController::class, 'index'])->name('cashout');

    //create cashout-reqeust
    Route::post('CreatePayOutRequest', [CashoutController::class, 'CreatePayOutRequest'])->name('request_cashout');

    //
    Route::post('update-cr-status', [CashoutController::class, 'updateCashOutRequestStatus'])->name('update-cr-status');

    //update buyer
    Route::post('update-buyer', [UserController::class, 'update_user'])->name('update-buyer');

    //update-request
    Route::post('update-request', [RequestController::class, 'update_request'])->name('update-request');

    //update user setting
    Route::post('update-setting', [UserController::class, 'update_settings'])->name('update-setting');

    //announcement
    Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::post('add-announcement', [AnnouncementController::class, 'store'])->name('add-announcement');

    //da_sellers
    Route::get('da-sellers', [UserController::class, 'da_sellers'])->name('da-sellers');

    //update-user status
    Route::post('update-seller-status', [UserController::class, 'updateSellerStatus'])->name('update-seller-status');

    //da-scanner
    Route::get('da-scanner', [ItemController::class, 'da_scanner'])->name('da-scanner');

});

Route::post('/post', [ItemController::class, 'index']);


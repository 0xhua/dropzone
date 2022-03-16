<?php


use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ItemController;

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
    return view('home');
})->name('home');

Route::get('login', function (){
    return redirect()->to(route('home').'#login');
})->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::get('seller_dashboard', [ItemController::class, 'seller_dashboard'])->name('seller_dashboard');
    Route::get('seller_itemlist', [ItemController::class, 'seller_itemlist'])->name('seller_itemlist');

    Route::resource('items', ItemController::class);

});

Route::post('/post', [ItemController::class, 'index']);


<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::middleware('auth')->group(function(){
//     Route::get('/',[SosmedController::class,'admin'])->name('admin');
// Route::post('export-youtube',[SosmedController::class,'exportYoutube'])->name('exportYoutube');
// Route::post('export-instagram',[SosmedController::class,'exportInstagram'])->name('exportInstagram');

// Route::get('/logout',[AuthController::class,'logout'])->name('logout');
// });

Route::middleware('auth')->group(function () {

    //home
    Route::get('/', [KasirController::class, 'index'])->name('kasir');
    Route::post('checkout', [KasirController::class, 'checkout'])->name('checkout');
    Route::get('printNota', [KasirController::class, 'printNota'])->name('printNota');
    //end home

    //block
    Route::get('forbidden-access', [AuthController::class, 'block'])->name('block');
    //endblock
    Route::get('ganti-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');
    Route::post('edit-password', [UserController::class, 'editPassword'])->name('editPassword');



    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('non-active', [AuthController::class, 'nonActive'])->name('nonActive');
});




Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

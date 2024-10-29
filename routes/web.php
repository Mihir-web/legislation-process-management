<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillsController;


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
// })->name('homepage');



// Admin routes
Route::group(['prefix' => '/'], function () {
Auth::routes();
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/','middleware' => 'is_admin'], function () {
  
// Route::get('home', [HomeController::class, 'adminHome'])->name('adminHome');

Route::group(['middleware' => 'is_reviewer'], function () {

    Route::get('/bills',[BillsController::class, 'index'])->name('bills');
    

    Route::group(['middleware' => 'is_mp'], function () {    

        Route::get('/bills/create',[BillsController::class, 'create'])->name('billCreate');
        Route::post('/bills/create',[BillsController::class, 'store'])->name('billStore');
        Route::get('/bills/update/{id}',[BillsController::class, 'edit'])->name('billEdit');
        Route::post('/bills/update',[BillsController::class, 'update'])->name('billUpdate');
        Route::post('/bills/delete',[BillsController::class, 'delete'])->name('billDelete');
        Route::post('/bills/statusChange',[BillsController::class, 'statuschange'])->name('billStatusChange');
        Route::group(['middleware' => 'is_superadmin'], function () {
            // bills
            
           
});


// Contact Us Leads
Route::get('/contactLeads',[ContactLeadsController::class, 'index'])->name('adminContactLeads');
Route::post('/contactLeads/delete',[ContactLeadsController::class, 'delete'])->name('adminContactLeadsDelete');
Route::post('/contactLeads/statusChange',[ContactLeadsController::class, 'statuschange'])->name('adminContactLeadStatusChange');
Route::get('/contactLeads/export', [ContactLeadsController::class, 'export'])->name('adminContactLeadsexport');
});
});
});
<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('refreshcaptcha', [App\Http\Controllers\Auth\LoginController::class, 'refreshcaptcha'])->name('refreshCaptcha');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('/');
Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login/login');
Route::post('logout',[App\Http\Controllers\Auth\LoginController::class,'Logout'])->name('logout');


Route::group(['middleware' => ['auth']], function() {
        Route::get('/home', [App\Http\Controllers\Dashbored\DashboradController::class, 'index'])->name('home');
        Route::get('users', [App\Http\Controllers\Dashbored\UserController::class, 'index'])->name('users');
        Route::get('users/create', [App\Http\Controllers\Dashbored\UserController::class, 'create'])->name('users/create');
        Route::post('users/create', [App\Http\Controllers\Dashbored\UserController::class, 'store'])->name('users/store');
        Route::get('users/show/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'show'])->name('users/show');
        Route::get('users/edit/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'edit'])->name('users/edit');
        Route::POST('users/edit/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'update'])->name('users/update');
        Route::get('/change-password', [App\Http\Controllers\Dashbored\UserController::class, 'changePassword'])->name('change-password');
        Route::post('/change-password', [App\Http\Controllers\Dashbored\UserController::class, 'updatePassword'])->name('update-password');
        Route::delete('users/destroy/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'destroy'])->name('users/destroy');
        Route::get('users/changeStatus/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'changeStatus'])->name('users/changeStatus');
        Route::get('users/profile/{id}', [App\Http\Controllers\Dashbored\UserController::class, 'profile'])->name('users/profile');
        Route::post('users/uploadPersonImage', [App\Http\Controllers\Dashbored\UserController::class, 'ImageUploadStore'])->name('users/uploadPersonImage');


        // *********************roles**********************
        Route::get('roles', [App\Http\Controllers\Dashbored\RoleController::class, 'index'])->name('roles');
        Route::get('roles/create', [App\Http\Controllers\Dashbored\RoleController::class, 'create'])->name('roles/create');
        Route::post('roles/create', [App\Http\Controllers\Dashbored\RoleController::class, 'store'])->name('roles/store');
        Route::get('roles/show/{id}', [App\Http\Controllers\Dashbored\RoleController::class, 'show'])->name('roles/show');
        Route::get('roles/edit/{id}', [App\Http\Controllers\Dashbored\RoleController::class, 'edit'])->name('roles/edit');
        Route::POST('roles/edit/{id}', [App\Http\Controllers\Dashbored\RoleController::class, 'update'])->name('roles/update');
        Route::delete('roles/destroy/{id}', [App\Http\Controllers\Dashbored\RoleController::class, 'destroy'])->name('roles/destroy');


        Route::get('branches', [App\Http\Controllers\Dashbored\BrancheController::class, 'index'])->name('branches');
        Route::get('branches/create', [App\Http\Controllers\Dashbored\BrancheController::class, 'create'])->name('branches/create');
        Route::post('branches/create', [App\Http\Controllers\Dashbored\BrancheController::class, 'store'])->name('branches/store');
        Route::get('branches/edit/{id}', [App\Http\Controllers\Dashbored\BrancheController::class, 'edit'])->name('branches/edit');
        Route::POST('branches/edit/{id}', [App\Http\Controllers\Dashbored\BrancheController::class, 'update'])->name('branches/update');
        Route::get('branches/changeStatus/{id}', [App\Http\Controllers\Dashbored\BrancheController::class, 'changeStatus'])->name('branches/changeStatus');




        Route::get('sms_messages', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'index'])->name('sms_messages');
        Route::get('sms_messages/sms_messages', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'smsMessages'])->name('sms_messages/sms_messages');

        Route::get('sms_messages/create', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'create'])->name('sms_messages/create');
        Route::post('sms_messages/create', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'store'])->name('sms_messages/store');
        Route::get('sms_messages/createbyexcel', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'createbyexcel'])->name('sms_messages/send_by_excel');
        Route::post('sms_messages/createbyexcel', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'storebyexcel'])->name('sms_messages/store_by_excel');
        Route::get('sms_messages/sendagain/{id}', [App\Http\Controllers\Dashbored\SMSMessagesController::class, 'sendagain'])->name('sms_messages/send_again');



        // Route::get('local_block_lists/uplode', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'uplode'])->name('local_block_lists/uplode');
        // Route::post('local_block_lists/uplode', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'storeUplode'])->name('local_block_lists/store_uplode');

        // Route::get('local_block_lists', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'index'])->name('local_block_lists');

        // Route::get('local_block_lists/create', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'create'])->name('local_block_lists/create');
        // Route::post('local_block_lists/create', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'store'])->name('local_block_lists/store');

        // Route::get('local_block_lists/edit/{id}', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'edit'])->name('local_block_lists/edit');
        // Route::POST('local_block_lists/edit/{id}', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'update'])->name('local_block_lists/update');
        // Route::get('local_block_lists/export', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'export'])->name('local_block_lists/export');
        // Route::get('local_block_lists/print', [App\Http\Controllers\Dashbored\LocalBlockListsController::class, 'print'])->name('local_block_lists.print');
        Route::get('logger/activity', [App\Http\Controllers\Dashbored\ActivityLogController::class, 'index'])->name('logger/activity');

});

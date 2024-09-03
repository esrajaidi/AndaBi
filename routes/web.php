<?php

use Illuminate\Support\Facades\Route;
use App\Exports\FinancialDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Classes\HelperC;
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

        Route::get('transaction_o_b_d_x_e_s', [App\Http\Controllers\Dashbored\TransactionOBDXController::class, 'index'])->name('transaction_o_b_d_x_e_s');
        Route::get('transaction_o_b_d_x_e_s/uplode', [App\Http\Controllers\Dashbored\TransactionOBDXController::class, 'uplode'])->name('transaction_o_b_d_x_e_s/uplode');
        Route::post('transaction_o_b_d_x_e_s/uplode', [App\Http\Controllers\Dashbored\TransactionOBDXController::class, 'storeUplode'])->name('transaction_o_b_d_x_e_s/store_uplode');
        Route::get('transaction_o_b_d_x_e_s/report/branche', [App\Http\Controllers\Dashbored\TransactionOBDXController::class, 'generateReportView'])->name('transaction_o_b_d_x_e_s/report/branche');
        Route::get('transaction_o_b_d_x_e_s/report/', [App\Http\Controllers\Dashbored\TransactionOBDXController::class, 'generateReportViewAll'])->name('transaction_o_b_d_x_e_s/report');

        Route::get('transaction_o_b_d_x_coms', [App\Http\Controllers\Dashbored\TransactionOBDXComController::class, 'index'])->name('transaction_o_b_d_x_coms');
        Route::get('transaction_o_b_d_x_coms/uplode', [App\Http\Controllers\Dashbored\TransactionOBDXComController::class, 'uplode'])->name('transaction_o_b_d_x_coms/uplode');
        Route::post('transaction_o_b_d_x_coms/uplode', [App\Http\Controllers\Dashbored\TransactionOBDXComController::class, 'storeUplode'])->name('transaction_o_b_d_x_coms/store_uplode');
        Route::get('transaction_o_b_d_x_coms/report/branche', [App\Http\Controllers\Dashbored\TransactionOBDXComController::class, 'generateReportView'])->name('transaction_o_b_d_x_coms/report/branche');
        Route::get('transaction_o_b_d_x_coms/report/', [App\Http\Controllers\Dashbored\TransactionOBDXComController::class, 'generateReportViewAll'])->name('transaction_o_b_d_x_coms/report');


        Route::get('transaction_p_o_s', [App\Http\Controllers\Dashbored\TransactionPOSController::class, 'index'])->name('transaction_p_o_s');
        Route::get('transaction_p_o_s/uplode', [App\Http\Controllers\Dashbored\TransactionPOSController::class, 'uplode'])->name('transaction_p_o_s/uplode');
        Route::post('transaction_p_o_s/uplode', [App\Http\Controllers\Dashbored\TransactionPOSController::class, 'storeUplode'])->name('transaction_p_o_s/store_uplode');
        Route::get('transaction_p_o_s/report/branche', [App\Http\Controllers\Dashbored\TransactionPOSController::class, 'generateReportView'])->name('transaction_p_o_s/report/branche');
        Route::get('transaction_p_o_s/report/', [App\Http\Controllers\Dashbored\TransactionPOSController::class, 'generateReportViewAll'])->name('transaction_p_o_s/report');


        Route::get('transaction_w_u_s', [App\Http\Controllers\Dashbored\TransactionWUController::class, 'index'])->name('transaction_w_u_s');
        Route::get('transaction_w_u_s/uplode', [App\Http\Controllers\Dashbored\TransactionWUController::class, 'uplode'])->name('transaction_w_u_s/uplode');
        Route::post('transaction_w_u_s/uplode', [App\Http\Controllers\Dashbored\TransactionWUController::class, 'storeUplode'])->name('transaction_w_u_s/store_uplode');
        Route::get('transaction_w_u_s/report/branche', [App\Http\Controllers\Dashbored\TransactionWUController::class, 'generateReportView'])->name('transaction_w_u_s/report/branche');
        Route::get('transaction_w_u_s/report/', [App\Http\Controllers\Dashbored\TransactionWUController::class, 'generateReportViewAll'])->name('transaction_w_u_s/report');

        Route::get('transaction_incom_w_u_s', [App\Http\Controllers\Dashbored\TransactionIncomWUController::class, 'index'])->name('transaction_incom_w_u_s');
        Route::get('transaction_incom_w_u_s/uplode', [App\Http\Controllers\Dashbored\TransactionIncomWUController::class, 'uplode'])->name('transaction_incom_w_u_s/uplode');
        Route::post('transaction_incom_w_u_s/uplode', [App\Http\Controllers\Dashbored\TransactionIncomWUController::class, 'storeUplode'])->name('transaction_incom_w_u_s/store_uplode');
        Route::get('transaction_incom_w_u_s/report/branche', [App\Http\Controllers\Dashbored\TransactionIncomWUController::class, 'generateReportView'])->name('transaction_incom_w_u_s/report/branche');
        Route::get('transaction_incom_w_u_s/report/', [App\Http\Controllers\Dashbored\TransactionIncomWUController::class, 'generateReportViewAll'])->name('transaction_incom_w_u_s/report');

        Route::get('transaction_card_issuing_fees', [App\Http\Controllers\Dashbored\TransactionCardIssuingFeesController::class, 'index'])->name('transaction_card_issuing_fees');
        Route::get('transaction_card_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionCardIssuingFeesController::class, 'uplode'])->name('transaction_card_issuing_fees/uplode');
        Route::post('transaction_card_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionCardIssuingFeesController::class, 'storeUplode'])->name('transaction_card_issuing_fees/store_uplode');
        Route::get('transaction_card_issuing_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionCardIssuingFeesController::class, 'generateReportView'])->name('transaction_card_issuing_fees/report/branche');
        Route::get('transaction_card_issuing_fees/report/', [App\Http\Controllers\Dashbored\TransactionCardIssuingFeesController::class, 'generateReportViewAll'])->name('transaction_card_issuing_fees/report');


        Route::get('transaction_card_re_issuing_fees', [App\Http\Controllers\Dashbored\TransactionCardReIssuingFeesController::class, 'index'])->name('transaction_card_re_issuing_fees');
        Route::get('transaction_card_re_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionCardReIssuingFeesController::class, 'uplode'])->name('transaction_card_re_issuing_fees/uplode');
        Route::post('transaction_card_re_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionCardReIssuingFeesController::class, 'storeUplode'])->name('transaction_card_re_issuing_fees/store_uplode');
        Route::get('transaction_card_re_issuing_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionCardReIssuingFeesController::class, 'generateReportView'])->name('transaction_card_re_issuing_fees/report/branche');
        Route::get('transaction_card_re_issuing_fees/report/', [App\Http\Controllers\Dashbored\TransactionCardReIssuingFeesController::class, 'generateReportViewAll'])->name('transaction_card_re_issuing_fees/report');

        Route::get('transaction_re_issuing_pin_fees', [App\Http\Controllers\Dashbored\TransactionReIssuingPinFeesController::class, 'index'])->name('transaction_re_issuing_pin_fees');
        Route::get('transaction_re_issuing_pin_fees/uplode', [App\Http\Controllers\Dashbored\TransactionReIssuingPinFeesController::class, 'uplode'])->name('transaction_re_issuing_pin_fees/uplode');
        Route::post('transaction_re_issuing_pin_fees/uplode', [App\Http\Controllers\Dashbored\TransactionReIssuingPinFeesController::class, 'storeUplode'])->name('transaction_re_issuing_pin_fees/store_uplode');
        Route::get('transaction_re_issuing_pin_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionReIssuingPinFeesController::class, 'generateReportView'])->name('transaction_re_issuing_pin_fees/report/branche');
        Route::get('transaction_re_issuing_pin_fees/report/', [App\Http\Controllers\Dashbored\TransactionReIssuingPinFeesController::class, 'generateReportViewAll'])->name('transaction_re_issuing_pin_fees/report');


        Route::get('transaction_incom_card_fees', [App\Http\Controllers\Dashbored\TransactionIncomCardFeesController::class, 'index'])->name('transaction_incom_card_fees');
        Route::get('transaction_incom_card_fees/uplode', [App\Http\Controllers\Dashbored\TransactionIncomCardFeesController::class, 'uplode'])->name('transaction_incom_card_fees/uplode');
        Route::post('transaction_incom_card_fees/uplode', [App\Http\Controllers\Dashbored\TransactionIncomCardFeesController::class, 'storeUplode'])->name('transaction_incom_card_fees/store_uplode');
        Route::get('transaction_incom_card_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionIncomCardFeesController::class, 'generateReportView'])->name('transaction_incom_card_fees/report/branche');
        Route::get('transaction_incom_card_fees/report/', [App\Http\Controllers\Dashbored\TransactionIncomCardFeesController::class, 'generateReportViewAll'])->name('transaction_incom_card_fees/report');


        Route::get('transaction_s_m_s', [App\Http\Controllers\Dashbored\TransactionSMSController::class, 'index'])->name('transaction_s_m_s');
        Route::get('transaction_s_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionSMSController::class, 'uplode'])->name('transaction_s_m_s/uplode');
        Route::post('transaction_s_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionSMSController::class, 'storeUplode'])->name('transaction_s_m_s/store_uplode');
        Route::get('transaction_s_m_s/report/branche', [App\Http\Controllers\Dashbored\TransactionSMSController::class, 'generateReportView'])->name('transaction_s_m_s/report/branche');
        Route::get('transaction_s_m_s/report/', [App\Http\Controllers\Dashbored\TransactionSMSController::class, 'generateReportViewAll'])->name('transaction_s_m_s/report');

        Route::get('transaction_s_m_s_c_o_m_s', [App\Http\Controllers\Dashbored\TransactionSMSCOMController::class, 'index'])->name('transaction_s_m_s_c_o_m_s');
        Route::get('transaction_s_m_s_c_o_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionSMSCOMController::class, 'uplode'])->name('transaction_s_m_s_c_o_m_s/uplode');
        Route::post('transaction_s_m_s_c_o_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionSMSCOMController::class, 'storeUplode'])->name('transaction_s_m_s_c_o_m_s/store_uplode');
        Route::get('transaction_s_m_s_c_o_m_s/report/branche', [App\Http\Controllers\Dashbored\TransactionSMSCOMController::class, 'generateReportView'])->name('transaction_s_m_s_c_o_m_s/report/branche');
        Route::get('transaction_s_m_s_c_o_m_s/report/', [App\Http\Controllers\Dashbored\TransactionSMSCOMController::class, 'generateReportViewAll'])->name('transaction_s_m_s_c_o_m_s/report');


        Route::get('transaction_a_t_m_s', [App\Http\Controllers\Dashbored\TransactionATMController::class, 'index'])->name('transaction_a_t_m_s');
        Route::get('transaction_a_t_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionATMController::class, 'uplode'])->name('transaction_a_t_m_s/uplode');
        Route::post('transaction_a_t_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionATMController::class, 'storeUplode'])->name('transaction_a_t_m_s/store_uplode');
        Route::get('transaction_a_t_m_s/report/branche', [App\Http\Controllers\Dashbored\TransactionATMController::class, 'generateReportView'])->name('transaction_a_t_m_s/report/branche');
        Route::get('transaction_a_t_m_s/report/', [App\Http\Controllers\Dashbored\TransactionATMController::class, 'generateReportViewAll'])->name('transaction_a_t_m_s/report');

        Route::get('transaction_master_card_issuing_fees', [App\Http\Controllers\Dashbored\TransactionMasterCardIssuingFeesController::class, 'index'])->name('transaction_master_card_issuing_fees');
        Route::get('transaction_master_card_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardIssuingFeesController::class, 'uplode'])->name('transaction_master_card_issuing_fees/uplode');
        Route::post('transaction_master_card_issuing_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardIssuingFeesController::class, 'storeUplode'])->name('transaction_master_card_issuing_fees/store_uplode');
        Route::get('transaction_master_card_issuing_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionMasterCardIssuingFeesController::class, 'generateReportView'])->name('transaction_master_card_issuing_fees/report/branche');
        Route::get('transaction_master_card_issuing_fees/report/', [App\Http\Controllers\Dashbored\TransactionMasterCardIssuingFeesController::class, 'generateReportViewAll'])->name('transaction_master_card_issuing_fees/report');

        Route::get('transaction_master_card_charging_fees', [App\Http\Controllers\Dashbored\TransactionMasterCardChargingFeesController::class, 'index'])->name('transaction_master_card_charging_fees');
        Route::get('transaction_master_card_charging_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardChargingFeesController::class, 'uplode'])->name('transaction_master_card_charging_fees/uplode');
        Route::post('transaction_master_card_charging_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardChargingFeesController::class, 'storeUplode'])->name('transaction_master_card_charging_fees/store_uplode');
        Route::get('transaction_master_card_charging_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionMasterCardChargingFeesController::class, 'generateReportView'])->name('transaction_master_card_charging_fees/report/branche');
        Route::get('transaction_master_card_charging_fees/report/', [App\Http\Controllers\Dashbored\TransactionMasterCardChargingFeesController::class, 'generateReportViewAll'])->name('transaction_master_card_charging_fees/report');

        Route::get('transaction_master_card_mangment_fees', [App\Http\Controllers\Dashbored\TransactionMasterCardMangmentFeesController::class, 'index'])->name('transaction_master_card_mangment_fees');
        Route::get('transaction_master_card_mangment_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardMangmentFeesController::class, 'uplode'])->name('transaction_master_card_mangment_fees/uplode');
        Route::post('transaction_master_card_mangment_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMasterCardMangmentFeesController::class, 'storeUplode'])->name('transaction_master_card_mangment_fees/store_uplode');
        Route::get('transaction_master_card_mangment_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionMasterCardMangmentFeesController::class, 'generateReportView'])->name('transaction_master_card_mangment_fees/report/branche');
        Route::get('transaction_master_card_mangment_fees/report/', [App\Http\Controllers\Dashbored\TransactionMasterCardMangmentFeesController::class, 'generateReportViewAll'])->name('transaction_master_card_mangment_fees/report');



        Route::get('transaction_a_t_m_o_f_f_u_s_fees', [App\Http\Controllers\Dashbored\TransactionATMOFFUSFeesController::class, 'index'])->name('transaction_a_t_m_o_f_f_u_s_fees');
        Route::get('transaction_a_t_m_o_f_f_u_s_fees/uplode', [App\Http\Controllers\Dashbored\TransactionATMOFFUSFeesController::class, 'uplode'])->name('transaction_a_t_m_o_f_f_u_s_fees/uplode');
        Route::post('transaction_a_t_m_o_f_f_u_s_fees/uplode', [App\Http\Controllers\Dashbored\TransactionATMOFFUSFeesController::class, 'storeUplode'])->name('transaction_a_t_m_o_f_f_u_s_fees/store_uplode');
        Route::get('transaction_a_t_m_o_f_f_u_s_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionATMOFFUSFeesController::class, 'generateReportView'])->name('transaction_a_t_m_o_f_f_u_s_fees/report/branche');
        Route::get('transaction_a_t_m_o_f_f_u_s_fees/report/', [App\Http\Controllers\Dashbored\TransactionATMOFFUSFeesController::class, 'generateReportViewAll'])->name('transaction_a_t_m_o_f_f_u_s_fees/report');


        Route::get('transaction_master_a_t_m_s', [App\Http\Controllers\Dashbored\TransactionMasterATMController::class, 'index'])->name('transaction_master_a_t_m_s');
        Route::get('transaction_master_a_t_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionMasterATMController::class, 'uplode'])->name('transaction_master_a_t_m_s/uplode');
        Route::post('transaction_master_a_t_m_s/uplode', [App\Http\Controllers\Dashbored\TransactionMasterATMController::class, 'storeUplode'])->name('transaction_master_a_t_m_s/store_uplode');
        Route::get('transaction_master_a_t_m_s/report/branche', [App\Http\Controllers\Dashbored\TransactionMasterATMController::class, 'generateReportView'])->name('transaction_master_a_t_m_s/report/branche');
        Route::get('transaction_master_a_t_m_s/report/', [App\Http\Controllers\Dashbored\TransactionMasterATMController::class, 'generateReportViewAll'])->name('transaction_master_a_t_m_s/report');



        Route::get('transaction_markup_fees', [App\Http\Controllers\Dashbored\TransactionMarkupFeesController::class, 'index'])->name('transaction_markup_fees');
        Route::get('transaction_markup_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMarkupFeesController::class, 'uplode'])->name('transaction_markup_fees/uplode');
        Route::post('transaction_markup_fees/uplode', [App\Http\Controllers\Dashbored\TransactionMarkupFeesController::class, 'storeUplode'])->name('transaction_markup_fees/store_uplode');
        Route::get('transaction_markup_fees/report/branche', [App\Http\Controllers\Dashbored\TransactionMarkupFeesController::class, 'generateReportView'])->name('transaction_markup_fees/report/branche');
        Route::get('transaction_markup_fees/report/', [App\Http\Controllers\Dashbored\TransactionMarkupFeesController::class, 'generateReportViewAll'])->name('transaction_markup_fees/report');


        Route::get('/export-financial-data', function () {
                $months = HelperC::months();
                return Excel::download(new FinancialDataExport($months), 'financial_data.xlsx');
            });
        Route::get('logger/activity', [App\Http\Controllers\Dashbored\ActivityLogController::class, 'index'])->name('logger/activity');

});

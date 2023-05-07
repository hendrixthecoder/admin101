<?php

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\AdminEmailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UsersController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\WdMethodsController;
use App\Http\Controllers\User\UserActionController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminActionController;
use App\Http\Controllers\Admin\AdminMethodController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\InvestmentPlansController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Artisan;

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


// Route::get('/', function (){
//     return redirect()->route('home');
// });
Route::get('mac', function (Request $request) {
    dd($request->ip());
});


Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('setLocale');

Route::get('/account', function (){
    return redirect()->route('home');
});

Route::get('/admin', function (){
    return redirect()->route('showAdminLoginForm');
});


//FOR SHOWING LOGIN FORM
Route::get('/log-in', [LoginController::class, 'showForm'])->name('logUserInForm');
//ACTION TO LOG USER IN
Route::post('login', [LoginController::class, 'logUserIn'])->name('logUserIn');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('register', [RegisterController::class, 'storeUser'])->name('storeUser');

//REFERRAL HANDLING
Route::get('/refer/{key}', [UserActionController::class, 'referralHandling'])->name('referralHandling');


//FORGOT PASSWORD
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


//PASSWORD RESETTING FORM

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token])->with('token', $token);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request){

    $validated = $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed'
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('logUserInForm')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

//ADMIN ROUTES

Route::group([ 'prefix' => 'admin'], function () {
    Route::get('/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'logAdminIn'])->name('logAdminIn');
    // Route::get('/register', [AdminRegisterController::class, 'showAdminRegisterForm'])->name('showAdminRegisterForm');
    // Route::post('/register', [AdminRegisterController::class, 'storeAdminUser'])->name('storeAdminUser');

    //ADMIN ROUTES THAT NEED AUTHENTIFICATION
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logAdminOut');
        Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->name('adminDashboard');
        Route::get('manage-users', [AdminPageController::class, 'manageUsers'])->name('manageUsers');
        Route::get('add-user', [AdminPageController::class, 'addUserForm'])->name('adminAddUserForm');
        Route::resource('/investment-plans', InvestmentPlansController::class)->only('store', 'destroy', 'index');
        Route::get('manage-withdrawals', [AdminPageController::class, 'manageWithdrawals'])->name('manageWithdrawals');

        Route::get('edit-profile', [AdminPageController::class, 'editProfile'])->name('adminEditProfile');
        Route::put('edit-profile', [AdminMethodController::class, 'editProfile'])->name('adminEditProfileStore');

        Route::get('/credit-user/{id}', [AdminPageController::class, 'creditUser'])->name('creditUserForm');
        Route::post('/credit-user/{id}', [AdminMethodController::class, 'creditUser'])->name('creditUser');

        Route::get('/debit-user/{id}', [AdminPageController::class, 'debitUser'])->name('debitUserForm');
        Route::post('/debit-user/{id}', [AdminMethodController::class, 'debitUser'])->name('debitUser');

        Route::get('/site-settings', [AdminPageController::class, 'siteSettingsPage'])->name('siteSettingsPage');
        Route::post('/site-settings/add-wdmethod', [WdMethodsController::class, 'addWithdrawalMethod'])->name('addWithdrawalMethod');
        Route::post('/site-settings/edit-payment-details', [SiteSettingsController::class, 'editPaymentDetails'])->name('editPaymentDetails');
        Route::post('/site-settings/edit-payment-status', [SiteSettingsController::class, 'editPaymentStatus'])->name('editPaymentStatus');
        Route::post('site-settings/edit-preferences', [SiteSettingsController::class, 'editPreferences'])->name('editSitePreferences');

        //ADMIN ACTION
        Route::post('user/{id}/lock', [AdminMethodController::class, 'lockUser'])->name('adminLockUser');
        Route::post('user/{id}/unlock', [AdminMethodController::class, 'unlockUser'])->name('adminUnlockUser');

        Route::post('user/{id}/toggle-withdrawal', function ($id) {
            $user = User::findOrFail($id);
            if($user->can_withdraw){

                $user->can_withdraw = false;
            }else{

                $user->can_withdraw = true;
            }
            
            $user->save();

            return back()->with('success', 'Action successful!');
            
        })->name('adminToggleUserWithdrawal');

        Route::get('user/{id}/send-email', [AdminMethodController::class, 'emailUser'])->name('adminEmailUser');
        Route::post('user/{id}/send-email', [AdminMethodController::class, 'postEmailUser'])->name('postAdminEmailUser');

        Route::get('user/{user}/edit', [AdminActionController::class, 'edit'])->name('adminEditUserForm');
        Route::put('user/{user}', [AdminActionController::class, 'update'])->name('adminEditUser');

        Route::get('manage-deposits', [AdminPageController::class, 'manageDeposits'])->name('manageDeposits');
        Route::post('approve-deposit/{id}', [AdminMethodController::class, 'approveDeposit'])->name('approveDeposit');
        Route::post('decline-deposit/{id}', [AdminMethodController::class, 'declineDeposit'])->name('declineDeposit');

        Route::post('approve-withdrawal/{id}', [AdminMethodController::class, 'approveWithdrawal'])->name('approveWithdrawal');
        Route::post('decline-withdrawal/{id}', [AdminMethodController::class, 'declineWithdrawal'])->name('declineWithdrawal');

        Route::get('user/{id}/get-referrals', [AdminMethodController::class, 'getUserReferrals'])->name('adminGetUserReferrals');

        Route::post('allow-withdrawals', [SiteSettingsController::class, 'allowWithdrawals'])->name('allowWithdrawals');
        Route::get('manage-kyc', [AdminPageController::class, 'manageKyc'])->name('manageKyc');
        Route::post('approve-kyc', [AdminMethodController::class, 'approveKyc'])->name('approveKyc');
        Route::post('decline-kyc', [AdminMethodController::class, 'declineKyc'])->name('declineKyc');

        Route::get('setup', function () {
            Artisan::call('migrate:refresh');
            Artisan::call('db:seed');
            return 'Successful';
        });
    });

});



//USER ROUTES 

Route::group(['middleware' => 'auth', 'namespace' => 'User'], function () {
    Route::get('/dashboard', [UserPageController::class, 'home'])->name('home');

    Route::post('/payment', [UserPageController::class, 'makePayment'])->name('makePayment');

    Route::get('/investment-plans', [UserPageController::class, 'investplans'])->name('investplans');

    Route::post('/investment-plans/{id}', [UserActionController::class, 'joinPlan'])->name('joinPlan');

    Route::get('/accountdetails', [UserPageController::class, 'acctinfo'])->name('acctinfo');

    Route::get('/support', [UserPageController::class, 'support'])->name('support');

    Route::get('/mydeposits', [UserPageController::class, 'deposits'])->name('deposits');

    Route::get('/withdrawals', [UserPageController::class, 'withdrawals'])->name('mywithdrawals');

    Route::get('/myplans', [UserPageController::class, 'myplans'])->name('myplans');

    Route::get('/accounthistory', [UserPageController::class, 'accthist'])->name('accthist');

    Route::get('/refer', [UserPageController::class, 'refer'])->name('refer');

    Route::post('change-password', [UserActionController::class, 'changePassword'])->name('userChangePassword');

    Route::post('verify-kyc', [UserActionController::class, 'setKyc'])->name('setKyc');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UsersController::class)->except(['store']);
    Route::resource('deposits', DepositsController::class);
    Route::resource('withdrawals', WithdrawalController::class)->only('store');
    
    Route::group(['prefix' => 'user'], function () {
        Route::resource('transactions', TransactionController::class)->only('store');
    });
});

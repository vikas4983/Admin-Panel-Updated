<?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//=================================================================================================


use App\Http\Controllers\admin\countries\CityController;
use App\Http\Controllers\admin\countries\CountryController;
use App\Http\Controllers\admin\countries\StateController;
use App\Http\Controllers\admin\educations\EducationController;
use App\Http\Controllers\admin\educations\OccupationController;
use App\Http\Controllers\admin\employees\EmployeeController;
use App\Http\Controllers\admin\incomes\IncomeController;
use App\Http\Controllers\admin\religions\CasteController;
use App\Http\Controllers\admin\religions\ReligionController;
use App\Http\Controllers\admin_auth\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PayUController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RazorpayPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailControllerController;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\LoginWithOTPController;
use App\Http\Controllers\LogoFaviconController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\ProfileIdController;
use App\Http\Controllers\SiteConfigController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SpoteLightController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\TextPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin_auth\MobileLoginController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\ModelCountController;
use App\Models\City;
use App\Models\Email;
use App\Models\Payment;
use Aws\Middleware;


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

// Route::fallback(function () {
//     if (Auth::user()) {
//         return redirect('dashboard');
//     }
//     return view('auth.login');
// });

Route::get('abc', function () {
    session()->flush();
    session()->regenerateToken();
    Auth::guard('admin')->logout();
    return view('admin-login');
});

Route::get('lagoutC', function () {
    Auth::logout();
    return view('login');
});


Route::get('env-test', function () {
    return [
        'SMS_API_ID' => env('SMS_API_ID'),
        'SMS_API_PASSWORD' => env('SMS_API_PASSWORD')
    ];
});






Route::get('send-email', [EmailController::class,'loginWithOTP']);

// Admin Login with email & Password
    Route::middleware('admin.redirect')->group(function () {
    Route::view('admin-login', 'admin-login')->name('admin-login');
    Route::view('admin-create', 'admin-create')->name('admin-create');

    // Login With OTP
    Route::middleware(['CheckOTPSession'])->group(function () {
        Route::view('admin-login', 'admin-login');
    });
    Route::post('send-otp', [MobileLoginController::class, 'loginWithOTP']);
    Route::post('resend-otp', [MobileLoginController::class, 'resendOTP']);
    Route::get('verify-otp-form', [MobileLoginController::class, 'showForm']);
    Route::post('forgot-password', [MobileLoginController::class, 'forgetOTP']);
    // verify account
    Route::post('verify-account', [AdminController::class, 'verifyAccount']);

});
// Validate with Email & Password
Route::post('admin-validate', [AdminController::class, 'login']);

// Validate with Otp
Route::post('verify-otp', [MobileLoginController::class, 'verifyOtp']);
Route::post('verify-otp-forgot-password', [MobileLoginController::class, 'verifyOtpForgotPassword']);
Route::get('verify-otp-forgot-password', [MobileLoginController::class, 'showVerifyOtpForm']);
Route::post('admin-change-password', [MobileLoginController::class, 'changePassword']);

 Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admins.logout');
    Route::get('plan', [PlanController::class, 'plan']);
    Route::resource('admins', AdminController::class);
    Route::view('/banners', 'banners');
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);
    Route::resource('religions', ReligionController::class);
    Route::resource('castes', CasteController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('educations', EducationController::class);
    Route::resource('occupations', OccupationController::class);
    Route::resource('incomes', IncomeController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('logos', LogoFaviconController::class);
    Route::resource('favicons', FaviconController::class);
    Route::resource('banners', BannerController::class);
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    Route::resource('cmsPages', CmsPageController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('profileids', ProfileIdController::class);
    Route::resource('emailSettings', EmailSettingController::class);
    Route::resource('siteSettings', SiteSettingController::class);
    Route::resource('siteConfigs', SiteConfigController::class);
    Route::resource('approvals', ApprovalController::class);
    Route::resource('successStories', SuccessStoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('spotelights', SpoteLightController::class);
    Route::get('user-orders', [UserController::class, 'paidusersorders']);
    Route::resource('paymentgateways', PaymentGatewayController::class);
    Route::resource('emailTemplates', EmailTemplateController::class);
    Route::resource('modelCounts', ModelCountController::class);
    Route::resource('adminMenus', AdminMenuController::class);


    // CMS Delete,Active,InActive  Route
    Route::post('cms-destroy', [CmsPageController::class, 'checkBoxDelete']);
    Route::post('cms-active', [CmsPageController::class, 'activeItem']);
    Route::post('cms-inActive', [CmsPageController::class, 'inActiveItem']);

    //  User Active InActive Delete Route
    // Route::post('admin-destroy', [UserController::class, 'checkBoxDelete']);
    // Route::post('admin-active', [UserController::class, 'activeItem']);
    // Route::post('admin-inActive', [UserController::class, 'inActiveItem']);

    //  Country Active InActive Delete Route
    Route::post('countries-destroy', [CountryController::class, 'checkBoxDelete']);
    Route::post('countries-active', [CountryController::class, 'activeItem']);
    Route::post('countries-inActive', [CountryController::class, 'inActiveItem']);
    //  State Active InActive Delete Route
    Route::post('states-destroy', [StateController::class, 'checkBoxDelete']);
    Route::post('states-active', [StateController::class, 'activeItem']);
    Route::post('states-inActive', [StateController::class, 'inActiveItem']);
    //  City Active InActive Delete Route
    Route::post('cities-destroy', [CityController::class, 'checkBoxDelete']);
    Route::post('cities-active', [CityController::class, 'activeItem']);
    Route::post('cities-inActive', [CityController::class, 'inActiveItem']);
    //  Religion Active InActive Delete Route
    Route::post('religions-destroy', [ReligionController::class, 'checkBoxDelete']);
    Route::post('religions-active', [ReligionController::class, 'activeItem']);
    Route::post('religions-inActive', [ReligionController::class, 'inActiveItem']);
    //  Caste Active InActive Delete Route
    Route::post('castes-destroy', [CasteController::class, 'checkBoxDelete']);
    Route::post('castes-active', [CasteController::class, 'activeItem']);
    Route::post('castes-inActive', [CasteController::class, 'inActiveItem']);
    //  Employee Active InActive Delete Route
    Route::post('employees-destroy', [EmployeeController::class, 'checkBoxDelete']);
    Route::post('employees-active', [EmployeeController::class, 'activeItem']);
    Route::post('employees-inActive', [EmployeeController::class, 'inActiveItem']);
    //  Occupation Active InActive Delete Route
    Route::post('occupations-destroy', [OccupationController::class, 'checkBoxDelete']);
    Route::post('occupations-active', [OccupationController::class, 'activeItem']);
    Route::post('occupations-inActive', [OccupationController::class, 'inActiveItem']);
    //  Education Active InActive Delete Route
    Route::post('educations-destroy', [EducationController::class, 'checkBoxDelete']);
    Route::post('educations-active', [EducationController::class, 'activeItem']);
    Route::post('educations-inActive', [EducationController::class, 'inActiveItem']);
    //  Income Active InActive Delete Route
    Route::post('incomes-destroy', [IncomeController::class, 'checkBoxDelete']);
    Route::post('incomes-active', [IncomeController::class, 'activeItem']);
    Route::post('incomes-inActive', [IncomeController::class, 'inActiveItem']);
    //  Plan Active InActive Delete Route
    Route::post('plans-destroy', [PlanController::class, 'checkBoxDelete']);
    Route::post('plans-active', [PlanController::class, 'activeItem']);
    Route::post('plans-inActive', [PlanController::class, 'inActiveItem']);
    //  Logo Active InActive Delete Route
    Route::post('logos-destroy', [LogoFaviconController::class, 'checkBoxDelete']);
    Route::post('logos-active', [LogoFaviconController::class, 'activeItem']);
    Route::post('logos-inActive', [LogoFaviconController::class, 'inActiveItem']);
    //  Favicon Active InActive Delete Route
    Route::post('favicons-destroy', [FaviconController::class, 'checkBoxDelete']);
    Route::post('favicons-active', [FaviconController::class, 'activeItem']);
    Route::post('favicons-inActive', [FaviconController::class, 'inActiveItem']);
    //  Banner Active InActive Delete Route
    Route::post('banners-destroy', [BannerController::class, 'checkBoxDelete']);
    Route::post('banners-active', [BannerController::class, 'activeItem']);
    Route::post('banners-inActive', [BannerController::class, 'inActiveItem']);
    //  Menu Active InActive Delete Route
    Route::post('menus-destroy', [MenuController::class, 'checkBoxDelete']);
    Route::post('menus-active', [MenuController::class, 'activeItem']);
    Route::post('menus-inActive', [MenuController::class, 'inActiveItem']);
    //  ProfileId Active InActive Delete Route
    Route::post('profileids-destroy', [MenuController::class, 'checkBoxDelete']);
    Route::post('profileids-active', [MenuController::class, 'activeItem']);
    Route::post('profileids-inActive', [MenuController::class, 'inActiveItem']);

    // RazorPay
    Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index']);
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});

Route::get('/', function () {
    if (Auth::user()) {
        return view('dashboard');
    }
    return view('auth.login');
});
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
Route::get('/dashboard', function () {
    return "User dashboard";
})->name('dashboard');
//});

// LoginWithOTP
Route::get('loginWithOTP', function () {
    return view('auth.loginwithotp');
});
Route::match(['get', 'post'], 'sendOTP', [LoginWithOTPController::class, 'sendOTP']);
Route::view('verifyForm', [LoginWithOTPController::class, 'verifyForm']);
Route::post('verifyOTP', [LoginWithOTPController::class, 'verifyOTP']);

// Route::get('admin', function () {
//     return view('login');
// });
// Route::post('log', function () {
//     Auth::logout();
//     return view('myprofile.login');
// });
Route::get('create', [AdminController::class, 'create']);
Route::get('profile', [AdminController::class, 'twoFactor']);


route::middleware('auth')->group(function () {

    //Route::resource('myprofile', AdminController::class);


});

Route::get('home', function () {
    return view('index');
});

Route::prefix('admin')->group(function () {
    // Admin Auth
    Route::middleware(['admin'])->group(function () {});
});


Route::get('/mail', [EmailController::class, 'sendWelcomeEmail']);

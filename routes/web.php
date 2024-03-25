<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\BusinessCardController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Globals
|--------------------------------------------------------------------------
*/

// String for REGEX with all available languages, except EN as that's the default language
$languages = implode('|', array_keys(array_except(config('system.available_languages'), ['en'])));

/*
|--------------------------------------------------------------------------
| In case you can't configure www to non-www redirect in the hosting
| dashboard, you can point the DNS of both the top level as www subdomain
| to the script, and have the script redirect to non-www.
|--------------------------------------------------------------------------
*/

$domains_to_redirect = [
    'www.'.env('APP_HOST') => env('APP_HOST'),
];

foreach ($domains_to_redirect as $domain_to_redirect => $redirect_to) {
    if (starts_with(request()->getHttpHost(), $domain_to_redirect)) {
        if ($domain_to_redirect == 'www.'.$redirect_to) {
            Route::get('', function () use ($redirect_to) {
                return \Redirect::to('https://'.$redirect_to, 301);
            });
        }
        Route::get('{any?}', function ($any) use ($redirect_to) {
            return \Redirect::to('https://'.$redirect_to, 301);
        })->where('any', '.*');
    }
}

/*
|--------------------------------------------------------------------------
| Show main website, reseller website or redirect to login in case of
| premium account.
|--------------------------------------------------------------------------
*/

if ($languages != '') {
    Route::get('/{language?}', [WebsiteController::class, 'home'])->where('language', '['.$languages.']+')->name('home');
} else {
    Route::get('/', [WebsiteController::class, 'home'])->name('home');
}

Route::get('legal', [WebsiteController::class, 'legal'])->name('legal');
Route::get('privacy-policy', [WebsiteController::class, 'privacyPolicy'])->name('privacy-policy');

Route::get('install', [InstallationController::class, 'getInstall'])->name('installation');
Route::post('install', [InstallationController::class, 'postInstall']);

// Deals
Route::get('deal/{deal_hash}', [DealsController::class, 'viewDeal']);
Route::get('deal/download/{deal_hash}', [DealsController::class, 'downloadPdf']);

// Properties
Route::get('property/{property_hash}', [PropertiesController::class, 'viewProperty']);
Route::get('property/download/{property_hash}', [PropertiesController::class, 'downloadPdf']);

// Coupons
Route::get('coupon/{coupon_hash}', [CouponsController::class, 'viewCoupon']);
Route::post('coupon/redeem/{coupon_hash}', [CouponsController::class, 'postRedeemCoupon']);
Route::get('coupon/redeemed/{coupon_hash}', [CouponsController::class, 'couponRedeemed']);
Route::get('coupon/verify/{coupon_hash}', [CouponsController::class, 'verifyCoupon']);
Route::post('coupon/verify/{coupon_hash}', [CouponsController::class, 'postVerifyCoupon']);

// Rewards
Route::get('reward/{reward_hash}', [RewardsController::class, 'viewReward']);
Route::post('reward/redeem/{reward_hash}', [RewardsController::class, 'postRedeemReward']);
Route::get('reward/redeemed/{reward_hash}', [RewardsController::class, 'rewardRedeemed']);
Route::get('reward/verify/{reward_hash}', [RewardsController::class, 'verifyReward']);
Route::post('reward/verify/{reward_hash}', [RewardsController::class, 'postVerifyReward']);
Route::get('reward/check-in/{reward_hash}', [RewardsController::class, 'checkInReward']);
Route::get('reward/checked-in/{reward_hash}', [RewardsController::class, 'checkedInReward']);
Route::post('reward/check-in/{reward_hash}', [RewardsController::class, 'postCheckInReward']);

// Business card
Route::get('card/{card_hash}', [BusinessCardController::class, 'viewCard']);
Route::get('card/download/{card_hash}', [BusinessCardController::class, 'downloadVCard']);

// Pages
Route::get('page/{page_hash}', [PagesController::class, 'viewPage']);

// Videos
Route::get('video/{video_hash}', [VideosController::class, 'viewVideo']);

// QR
Route::get('qr/{qr_hash}', [QrController::class, 'viewQrCode']);

// Nearby Platform help
Route::get('dashboard/help', [HelpController::class, 'nearbyPlatformHelp'])->name('nearby-platform-help');
Route::get('dashboard/help/{page}', [HelpController::class, 'nearbyPlatformHelpPage'])->name('nearby-platform-help');
Route::get('dashboard/help/{page}/{sub}', [HelpController::class, 'nearbyPlatformHelpPageSub'])->name('nearby-platform-help');

// Secured web routes
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | QR codes
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/qr', [QrController::class, 'showQrCodes'])->name('qr');
    Route::get('dashboard/qr/add', [QrController::class, 'showAddQrCode'])->name('qr');
    Route::get('dashboard/qr/edit/{sl}', [QrController::class, 'showEditQrCode'])->name('qr');
    Route::post('dashboard/qr/save', [QrController::class, 'postQrCode']);
    Route::post('dashboard/qr/delete', [QrController::class, 'postDeleteQrCode']);
    Route::get('dashboard/qr/download/{sl}', [QrController::class, 'getDownloadQrCode']);

    /*
    |--------------------------------------------------------------------------
    | Deals
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/deals', [DealsController::class, 'showDeals'])->name('deals');
    Route::get('dashboard/deals/add', [DealsController::class, 'showAddDeal'])->name('deals');
    Route::get('dashboard/deals/edit/{sl}', [DealsController::class, 'showEditDeal'])->name('deals');
    Route::post('dashboard/deals/save', [DealsController::class, 'postDeal']);
    Route::post('dashboard/deals/delete', [DealsController::class, 'postDeleteDeal']);

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/properties', [PropertiesController::class, 'showProperties'])->name('properties');
    Route::get('dashboard/properties/add', [PropertiesController::class, 'showAddProperty'])->name('properties');
    Route::get('dashboard/properties/edit/{sl}', [PropertiesController::class, 'showEditProperty'])->name('properties');
    Route::post('dashboard/properties/save', [PropertiesController::class, 'postProperty']);
    Route::post('dashboard/properties/delete', [PropertiesController::class, 'postDeleteProperty']);

    /*
    |--------------------------------------------------------------------------
    | Coupons
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/coupons', [CouponsController::class, 'showCoupons'])->name('coupons');
    Route::get('dashboard/coupons/leads', [CouponsController::class, 'showLeads'])->name('coupons');
    Route::post('dashboard/coupons/leads/delete', [CouponsController::class, 'postDeleteLead']);
    Route::post('dashboard/coupons/leads/delete/selected', [CouponsController::class, 'postDeleteLeads']);
    Route::get('dashboard/coupons/leads/export', [CouponsController::class, 'getExportLeads']);
    Route::get('dashboard/coupons/add', [CouponsController::class, 'showAddCoupon'])->name('coupons');
    Route::get('dashboard/coupons/edit/{sl}', [CouponsController::class, 'showEditCoupon'])->name('coupons');
    Route::post('dashboard/coupons/save', [CouponsController::class, 'postCoupon']);
    Route::post('dashboard/coupons/delete', [CouponsController::class, 'postDeleteCoupon']);

    /*
    |--------------------------------------------------------------------------
    | Rewards
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/rewards', [RewardsController::class, 'showRewards'])->name('rewards');
    Route::get('dashboard/rewards/leads', [RewardsController::class, 'showLeads'])->name('rewards');
    Route::post('dashboard/rewards/leads/delete', [RewardsController::class, 'postDeleteLead']);
    Route::post('dashboard/rewards/leads/delete/selected', [RewardsController::class, 'postDeleteLeads']);
    Route::get('dashboard/rewards/leads/export', [RewardsController::class, 'getExportLeads']);
    Route::get('dashboard/rewards/add', [RewardsController::class, 'showAddReward'])->name('rewards');
    Route::get('dashboard/rewards/edit/{sl}', [RewardsController::class, 'showEditReward'])->name('rewards');
    Route::post('dashboard/rewards/save', [RewardsController::class, 'postReward']);
    Route::post('dashboard/rewards/delete', [RewardsController::class, 'postDeleteReward']);

    /*
    |--------------------------------------------------------------------------
    | Business cards
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/business-cards', [BusinessCardController::class, 'showCards'])->name('businessCards');
    Route::get('dashboard/business-cards/add', [BusinessCardController::class, 'showAddCard'])->name('businessCards');
    Route::get('dashboard/business-cards/edit/{sl}', [BusinessCardController::class, 'showEditCard'])->name('businessCards');
    Route::post('dashboard/business-cards/save', [BusinessCardController::class, 'postCard']);
    Route::post('dashboard/business-cards/delete', [BusinessCardController::class, 'postDeleteCard']);

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/pages', [PagesController::class, 'showPages'])->name('pages');
    Route::get('dashboard/pages/add', [PagesController::class, 'showAddPage'])->name('pages');
    Route::get('dashboard/pages/edit/{sl}', [PagesController::class, 'showEditPage'])->name('pages');
    Route::post('dashboard/pages/save', [PagesController::class, 'postPage']);
    Route::post('dashboard/pages/delete', [PagesController::class, 'postDeletePage']);

    /*
    |--------------------------------------------------------------------------
    | Videos
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard/videos', [VideosController::class, 'showVideos'])->name('videos');
    Route::get('dashboard/videos/add', [VideosController::class, 'showAddVideo'])->name('videos');
    Route::get('dashboard/videos/edit/{sl}', [VideosController::class, 'showEditVideo'])->name('videos');
    Route::post('dashboard/videos/save', [VideosController::class, 'postVideo']);
    Route::post('dashboard/videos/delete', [VideosController::class, 'postDeleteVideo']);
    Route::post('dashboard/videos/verify-url', [VideosController::class, 'postVerifyUrl']);

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */
    // Overview
    Route::get('dashboard/settings', [SettingsController::class, 'showSettings'])->name('settings');

    // Profile
    Route::get('dashboard/settings/profile', [SettingsController::class, 'showSettingsProfile'])->name('settingsProfile');
    Route::post('dashboard/settings/profile', [SettingsController::class, 'postSettingsProfile']);

    // Analytics
    Route::get('dashboard/settings/analytics', [SettingsController::class, 'showSettingsAnalytics'])->name('settingsAnalytics');
    Route::post('dashboard/settings/analytics', [SettingsController::class, 'postSettingsAnalytics']);

    // For owners and managers
    Route::middleware('role:owner,manager')->group(function () {

        // User management
        Route::get('dashboard/manage/users', [ManagerController::class, 'showUsers'])->name('manageUsers');
        Route::get('dashboard/manage/users/add', [ManagerController::class, 'showAddUser'])->name('manageUsers');
        Route::get('dashboard/manage/users/login/{sl}', [ManagerController::class, 'loginAsUser']);
        Route::get('dashboard/manage/users/edit/{sl}', [ManagerController::class, 'showEditUser'])->name('manageUsers');
        Route::post('dashboard/manage/users/save', [ManagerController::class, 'postUser']);
        Route::post('dashboard/manage/users/delete', [ManagerController::class, 'postDeleteUser']);
    });
});

//Auth::routes();

$optionalLanguageRoutes = function () {
    // Authentication Routes...
    Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [Auth\LoginController::class, 'login']);
    Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    // Password Reset Routes...
    Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset']);
};

if ($languages != '') {
    // Add routes with language-prefix
    Route::prefix('{language?}')->where(['language' => '['.$languages.']+'])->group($optionalLanguageRoutes);
}

// Add routes without prefix
$optionalLanguageRoutes();

<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LanguageController;
use App\Livewire\Privacy;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Frontend\ChatAIController;
use App\Http\Controllers\Frontend\MedicalEducationController;
use App\Http\Controllers\Frontend\DeepSeekChatController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CheckExpertSystemAccess;
use App\Http\Controllers\Frontend\CustomerServiceChatController;
use App\Http\Controllers\Backend\CustomerServiceController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home route
Route::get('home', [FrontendController::class, 'index'])->name('home');

// Language Switch
Route::get('language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.available_locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');

// Pages
Route::get('terms', Terms::class)->name('terms');
Route::get('privacy', Privacy::class)->name('privacy');

Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');

    Route::group(['middleware' => ['auth']], function () {
        /*
        |--------------------------------------------------------------------------
        | Users Routes
        |--------------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/edit', ['as' => "{$module_name}.profileEdit", 'uses' => "{$controller_name}@profileEdit"]);
        Route::patch('profile/update', ['as' => "{$module_name}.profileUpdate", 'uses' => "{$controller_name}@profileUpdate"]);
        Route::get('profile/changePassword', ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
        Route::patch('profile/changePassword', ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
        Route::get('profile/{username?}', ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
        Route::get("{$module_name}/emailConfirmationResend", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
        Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    });
});

/*
|--------------------------------------------------------------------------
| Backend Routes
| These routes need view-backend permission
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['can:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("{$module_name}", "{$controller_name}@index")->name("{$module_name}");
        Route::post("{$module_name}", "{$controller_name}@store")->name("{$module_name}.store");
    });

    /*
    |--------------------------------------------------------------------------
    | Notification Routes
    |--------------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/markAllAsRead", ['as' => "{$module_name}.markAllAsRead", 'uses' => "{$controller_name}@markAllAsRead"]);
    Route::delete("{$module_name}/deleteAll", ['as' => "{$module_name}.deleteAll", 'uses' => "{$controller_name}@deleteAll"]);
    Route::get("{$module_name}/{id}", ['as' => "{$module_name}.show", 'uses' => "{$controller_name}@show"]);

    /*
    |--------------------------------------------------------------------------
    | Backup Routes
    |--------------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/create", ['as' => "{$module_name}.create", 'uses' => "{$controller_name}@create"]);
    Route::get("{$module_name}/download/{file_name}", ['as' => "{$module_name}.download", 'uses' => "{$controller_name}@download"]);
    Route::get("{$module_name}/delete/{file_name}", ['as' => "{$module_name}.delete", 'uses' => "{$controller_name}@delete"]);

    /*
    |--------------------------------------------------------------------------
    | Roles Routes
    |--------------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("{$module_name}", "{$controller_name}");

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("{$module_name}/{id}/resend-email-confirmation", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
    Route::delete("{$module_name}/user-provider-destroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    Route::get("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
    Route::patch("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
    Route::get("{$module_name}/trashed", ['as' => "{$module_name}.trashed", 'uses' => "{$controller_name}@trashed"]);
    Route::patch("{$module_name}/{id}/trashed", ['as' => "{$module_name}.restore", 'uses' => "{$controller_name}@restore"]);
    Route::get("{$module_name}/index_data", ['as' => "{$module_name}.index_data", 'uses' => "{$controller_name}@index_data"]);
    Route::get("{$module_name}/index_list", ['as' => "{$module_name}.index_list", 'uses' => "{$controller_name}@index_list"]);
    Route::patch("{$module_name}/{id}/block", ['as' => "{$module_name}.block", 'uses' => "{$controller_name}@block", 'middleware' => ['can:block_users']]);
    Route::patch("{$module_name}/{id}/unblock", ['as' => "{$module_name}.unblock", 'uses' => "{$controller_name}@unblock", 'middleware' => ['can:block_users']]);
    Route::resource("{$module_name}", "{$controller_name}");
    Route::get('profile/{username?}', ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
});

/**
 * File Manager Routes.
 */
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('frontend.aboutus');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('frontend.contact.send');
Route::get('/partner', [FrontendController::class, 'partner'])->name('frontend.partner');

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/botman/tinker', [BotManController::class, 'tinker']);

// ChatAI Routes
Route::get('/chatai', [ChatAIController::class, 'index'])->name('frontend.chatai');
Route::post('/chatai/message', [ChatAIController::class, 'processMessage'])->name('frontend.chatai.message');
Route::post('/chatai/clear', [ChatAIController::class, 'clearHistory'])->name('frontend.chatai.clear');

Route::get('/deepseek-chat', [DeepSeekChatController::class, 'index'])->name('frontend.deepseek-chat');

Route::get('/medical-education', [MedicalEducationController::class, 'index'])->name('frontend.medicaleducation.index');

// Add these routes for Google authentication
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Payment routes (authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::get('/expert-system/payment', [PaymentController::class, 'showPaymentPage'])->name('expert-system.payment');
    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/status/{orderId}', [PaymentController::class, 'checkPaymentStatus'])->name('payment.status');
    Route::post('/payment/manual-check', [PaymentController::class, 'manualCheckStatus'])->name('payment.manual-check');
});

// Midtrans notification (no auth required)
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');

// Protected expert system route - HANYA SATU INI SAJA
Route::get('/expert-system', function () {
    return view('frontend.medicaleducation.expert-system');
})->middleware(['auth', CheckExpertSystemAccess::class])->name('expert-system');

// Debug routes untuk testing
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/debug/{orderId}', function($orderId) {
        $payment = \App\Models\Payment::where('order_id', $orderId)->first();
        
        if (!$payment) {
            return response()->json(['error' => 'Payment not found']);
        }
        
        $user = \App\Models\User::find($payment->user_id);
        
        return response()->json([
            'payment' => $payment,
            'user_access' => [
                'expert_system_access' => $user->expert_system_access,
                'expert_system_expires_at' => $user->expert_system_expires_at,
                'has_access' => $user->hasExpertSystemAccess()
            ]
        ]);
    });
    
    // Route untuk grant access manual (untuk testing)
    Route::get('/test-access-grant/{userId}', function($userId) {
        $user = \App\Models\User::find($userId);
        
        if (!$user) {
            return 'User not found';
        }
        
        // Grant access manually untuk testing
        $user->update([
            'expert_system_access' => true,
            'expert_system_expires_at' => now()->addDays(30)
        ]);
        
        return response()->json([
            'message' => 'Access granted manually',
            'user' => $user->only(['id', 'email', 'expert_system_access', 'expert_system_expires_at']),
            'has_access' => $user->hasExpertSystemAccess(),
            'redirect_url' => route('expert-system')
        ]);
    });
});




// Customer Service Chat Routes (Frontend)
Route::middleware(['auth'])->group(function () {
    Route::get('/customer-service/initialize', [CustomerServiceChatController::class, 'initializeChat'])
        ->name('customer-service.initialize');
    
    Route::post('/customer-service/send', [CustomerServiceChatController::class, 'sendMessage'])
        ->name('customer-service.send');
    
    Route::get('/customer-service/messages', [CustomerServiceChatController::class, 'getMessages'])
        ->name('customer-service.messages');
});

// Admin Customer Service Routes
Route::prefix('admin')->name('backend.')->middleware(['auth'])->group(function () {
    Route::get('/customer-service', [CustomerServiceController::class, 'index'])
        ->name('customer-service.index');
    
    Route::get('/customer-service/chat/{userId}', [CustomerServiceController::class, 'showChat'])
        ->name('customer-service.chat');
    
    Route::post('/customer-service/chat/{userId}/send', [CustomerServiceController::class, 'sendMessage'])
        ->name('customer-service.send');
    
    Route::get('/customer-service/chat/{userId}/messages', [CustomerServiceController::class, 'getNewMessages'])
        ->name('customer-service.messages');
    
    Route::get('/customer-service/sessions', [CustomerServiceController::class, 'getActiveSessions'])
        ->name('customer-service.sessions');
});

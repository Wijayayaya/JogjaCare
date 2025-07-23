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
use App\Http\Controllers\Backend\DestinationController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\MedicalCareController;
use App\Http\Controllers\MedicalAlterController;
use App\Http\Controllers\MedicalPointController;
use App\Http\Controllers\MedicalCostController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Api\QuizController as ApiQuizController;
use App\Http\Controllers\Api\ArticleController as ApiArticleController;
use App\Http\Controllers\Admin\HealthInformationController;
use App\Http\Controllers\Frontend\ExpertSystemController;
use App\Http\Controllers\Admin\AmbulanceController;
use Laravel\Socialite\Facades\Socialite;


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

// Medical Education Routes
Route::get('/medical-education', [MedicalEducationController::class, 'index'])->name('frontend.medicaleducation.index');
Route::get('/medical-education/articles', [MedicalEducationController::class, 'articles'])->name('frontend.medicaleducation.articles');

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

Route::resource('destinations', DestinationController::class);

Route::resource('destinations', DestinationController::class)->names([
    'index' => 'backend.destinations.index',
    'create' => 'backend.destinations.create',
    'store' => 'backend.destinations.store',
    'show' => 'backend.destinations.show',
    'edit' => 'backend.destinations.edit',
    'update' => 'backend.destinations.update',
    'destroy' => 'backend.destinations.destroy',
]);

// Dashboard Admin Routes - tanpa middleware, cek auth di controller
Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin.index');
Route::post('/dashboardadmin/send-message', [DashboardAdminController::class, 'sendMessage'])->name('dashboardadmin.send-message'); 

// Dashboard Admin Routes
Route::prefix('dashboardadmin')->name('dashboardadmin.')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('index');
    
    // Services Routes
    Route::prefix('services')->name('services.')->group(function () {
        // Medical Care CRUD Routes
        Route::resource('medical-care', App\Http\Controllers\MedicalCareController::class)->names([
            'index' => 'medicalcare.index',
            'create' => 'medicalcare.create', 
            'store' => 'medicalcare.store',
            'show' => 'medicalcare.show',
            'edit' => 'medicalcare.edit',
            'update' => 'medicalcare.update',
            'destroy' => 'medicalcare.destroy',
        ]);
        
        // Medical Alter CRUD Routes
        Route::resource('medical-alter', App\Http\Controllers\MedicalAlterController::class)->names([
            'index' => 'medicalalter.index',
            'create' => 'medicalalter.create', 
            'store' => 'medicalalter.store',
            'show' => 'medicalalter.show',
            'edit' => 'medicalalter.edit',
            'update' => 'medicalalter.update',
            'destroy' => 'medicalalter.destroy',
        ]);
        
        // Medical Point CRUD Routes
        Route::resource('medical-point', App\Http\Controllers\MedicalPointController::class)->names([
            'index' => 'medicalpoint.index',
            'create' => 'medicalpoint.create', 
            'store' => 'medicalpoint.store',
            'show' => 'medicalpoint.show',
            'edit' => 'medicalpoint.edit',
            'update' => 'medicalpoint.update',
            'destroy' => 'medicalpoint.destroy',
        ]);
        
        // Medical Center CRUD Routes
        Route::resource('medical-center', App\Http\Controllers\MedicalCenterController::class)->names([
            'index' => 'medicalcenter.index',
            'create' => 'medicalcenter.create', 
            'store' => 'medicalcenter.store',
            'show' => 'medicalcenter.show',
            'edit' => 'medicalcenter.edit',
            'update' => 'medicalcenter.update',
            'destroy' => 'medicalcenter.destroy',
        ]);
        
        // Medical Cost CRUD Routes
        Route::resource('medical-cost', MedicalCostController::class)->names([
            'index' => 'medicalcost.index',
            'create' => 'medicalcost.create', 
            'store' => 'medicalcost.store',
            'show' => 'medicalcost.show',
            'edit' => 'medicalcost.edit',
            'update' => 'medicalcost.update',
            'destroy' => 'medicalcost.destroy',
        ]);

        Route::get('/medical-education', [DashboardAdminController::class, 'medicalEducation'])->name('medicaleducation');
    });

    // Chat Management Routes
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('/messages/{userId}', [ChatController::class, 'getMessages'])->name('messages');
        Route::post('/send', [ChatController::class, 'sendMessage'])->name('send');
        Route::post('/mark-read/{userId}', [ChatController::class, 'markAsRead'])->name('mark-read');
        Route::delete('/session/{sessionId}', [ChatController::class, 'deleteSession'])->name('delete-session');
        Route::get('/unread-count', [ChatController::class, 'getUnreadCount'])->name('unread-count');
        Route::post('/assign/{sessionId}', [ChatController::class, 'assignToAdmin'])->name('assign');
    });
    // Management routes
    Route::prefix('management')->name('management.')->group(function () {
        // Destination CRUD Routes
        Route::resource('destination', AdminDestinationController::class);
        Route::post('destination/{destination}/toggle-status', [AdminDestinationController::class, 'toggleStatus'])->name('destination.toggle-status');
    });

    // Admin Quiz Routes
    Route::prefix('dashboardadmin')->name('dashboardadmin.')->group(function () {
        Route::resource('quiz', QuizController::class);
        Route::patch('quiz/{quiz}/toggle-status', [QuizController::class, 'toggleStatus'])
            ->name('quiz.toggle-status');
    });

    // Ambulance Management - NEW ROUTES
    Route::prefix('ambulance')->name('ambulance.')->group(function () {
    Route::get('/', [AmbulanceController::class, 'index'])->name('index');
    Route::get('/create', [AmbulanceController::class, 'create'])->name('create');
    Route::post('/', [AmbulanceController::class, 'store'])->name('store');
    Route::get('/{ambulance}', [AmbulanceController::class, 'show'])->name('show');
    Route::get('/{ambulance}/edit', [AmbulanceController::class, 'edit'])->name('edit');
    Route::put('/{ambulance}', [AmbulanceController::class, 'update'])->name('update');
    Route::delete('/{ambulance}', [AmbulanceController::class, 'destroy'])->name('destroy');
    
    // Sub-menu routes
    Route::get('/emergency-contacts', [AmbulanceController::class, 'emergencyContacts'])->name('emergency-contacts');
    Route::get('/hospitals', [AmbulanceController::class, 'hospitals'])->name('hospitals');
    Route::get('/private-services', [AmbulanceController::class, 'privateServices'])->name('private-services');

    
});

});

// Route untuk admin quiz management,articles
Route::prefix('dashboardadmin')->name('dashboardadmin.')->group(function () {
    Route::resource('quiz', QuizController::class);
    Route::patch('quiz/{quiz}/toggle-status', [QuizController::class, 'toggleStatus'])->name('quiz.toggle-status');

    // Route untuk admin article management
    Route::resource('articles', ArticleController::class);
    Route::patch('articles/{article}/toggle-status', [ArticleController::class, 'toggleStatus'])->name('articles.toggle-status');

    // Health Information routes
    Route::resource('health-information', HealthInformationController::class);
    Route::patch('health-information/{healthInformation}/toggle-status', [HealthInformationController::class, 'toggleStatus'])->name('health-information.toggle-status');
    Route::post('health-information/bulk-action', [HealthInformationController::class, 'bulkAction'])->name('health-information.bulk-action');

    
});



// API route untuk frontend quiz data,articles
Route::get('/api/quiz-data', [ApiQuizController::class, 'index']);
Route::get('/api/articles-data', [ApiArticleController::class, 'index']);

// Frontend Expert System Routes - Fix the route name and structure
Route::get('/medical-education/expert-system', [MedicalEducationController::class, 'expertSystem'])->name('frontend.medicaleducation.expert-system');

// Add the API route for health information
Route::get('/api/health-information', [MedicalEducationController::class, 'getHealthInformation']);


<?php
use App\Http\Controllers\DreamerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectKindController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RewardDetailController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProjectCreationRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::prefix('admin')->group(function () {
    Voyager::routes();
});

use TCG\Voyager\Facades\Voyager;

Route::prefix('admin')->group(function () {
    Voyager::routes();
});



// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

use App\Http\Controllers\PageController;

// Static pages
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/guide', [PageController::class, 'guide'])->name('guide');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/commercial-law', [PageController::class, 'commercialLaw'])->name('commercial-law');
    Route::get('/company', [PageController::class, 'company'])->name('company');

// Test mail route (remove after configuration)
Route::get('/test-mail', function() {
    try {
        Mail::raw('テストメール', function ($message) {
            $message->to('uknight.sc@hachiouji-uknight.com')
                    ->subject('メール送信テスト');
        });
        return 'メール送信成功！';
    } catch (\Exception $e) {
        return 'メール送信失敗: ' . $e->getMessage();
    }
})->name('test.mail');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Project creation requests
    Route::prefix('project-creation-requests')->name('project-creation-requests.')->group(function () {
        Route::get('/create', [ProjectCreationRequestController::class, 'create'])->name('create');
        Route::post('/', [ProjectCreationRequestController::class, 'store'])->name('store');
    });
    
    // Project management
    Route::resource('projects', ProjectController::class)->except(['show'])->middleware('throttle:5,1');
    
    // Public project routes
    Route::get('/projects/category/{category}', [ProjectController::class, 'category'])->name('projects.category');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Purchase routes
    Route::prefix('projects/{project}/purchase')->name('purchase.')->group(function () {
        Route::get('/complete', [PurchaseController::class, 'complete'])->name('complete');
        Route::get('/success', [PurchaseController::class, 'success'])->name('success');
        Route::get('/cancel', [PurchaseController::class, 'cancel'])->name('cancel');
        Route::get('/confirm', [PurchaseController::class, 'confirm'])->name('confirm');
        Route::post('/confirm', [PurchaseController::class, 'confirm'])->name('confirm.post')->middleware('throttle:10,1');
        Route::post('/store', [PurchaseController::class, 'store'])->name('store')->middleware('throttle:10,1');
        Route::get('/', [PurchaseController::class, 'create'])->name('create');
    });

    // Dashboard routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/purchase-history', [DashboardController::class, 'purchaseHistory'])->name('purchaseHistory');
        Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update')->middleware('throttle:3,1');

        // Project dashboard
        Route::prefix('projects')->name('projects.')->group(function () {
            Route::get('/', [App\Http\Controllers\Dashboard\ProjectDashboardController::class, 'index'])->name('index');
            Route::get('/{project}', [App\Http\Controllers\Dashboard\ProjectDashboardController::class, 'show'])->name('show');
            Route::get('/{project}/supporters', [App\Http\Controllers\Dashboard\ProjectDashboardController::class, 'supporters'])->name('supporters');
            Route::resource('{project}/updates', App\Http\Controllers\Dashboard\ProjectUpdateController::class)->except(['show']);
        });
    });

    // Other resources
    Route::resources([
        'dreamers' => DreamerController::class,
        'supporters' => SupporterController::class,
        'orders' => OrderController::class,
        'project_categories' => ProjectCategoryController::class,
        'project_kinds' => ProjectKindController::class,
        'rewards' => RewardController::class,
        'reward_details' => RewardDetailController::class,
        'inventories' => InventoryController::class,
        'supports' => SupportController::class,
    ]);

    Route::get('/purchase-history', [PurchaseHistoryController::class, 'index'])->name('purchase.history');

    Route::post('/checkout', [SupportController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [SupportController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [SupportController::class, 'cancel'])->name('checkout.cancel');
});

// Admin routes
Route::prefix('manage')->middleware(['auth', 'role:admin,moderator', 'throttle:30,1'])->name('manage.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\DashboardController::class, 'users'])->name('users');
    Route::get('/projects', [App\Http\Controllers\Admin\DashboardController::class, 'projects'])->name('projects');
    Route::get('/supports', [App\Http\Controllers\Admin\DashboardController::class, 'supports'])->name('supports');
    Route::get('/login-history', [App\Http\Controllers\Admin\DashboardController::class, 'loginHistory'])->name('login-history');
    
    // Project creation requests management
    Route::prefix('project-creation-requests')->name('project-creation-requests.')->group(function () {
        Route::get('/', [ProjectCreationRequestController::class, 'index'])->name('index');
        Route::get('/{request}', [ProjectCreationRequestController::class, 'show'])->name('show');
        Route::post('/{request}/approve', [ProjectCreationRequestController::class, 'approve'])->name('approve');
        Route::post('/{request}/reject', [ProjectCreationRequestController::class, 'reject'])->name('reject');
        Route::delete('/{request}', [ProjectCreationRequestController::class, 'destroy'])->name('destroy');
    });
});

// Test routes
Route::get('/test-500', function () {
    throw new \Exception('テスト用の500エラー');
});

// Authentication routes
require __DIR__.'/auth.php';



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Custom admin pages
Route::prefix('admin')->middleware(['auth', 'role:admin,moderator', 'throttle:30,1'])->name('admin.')->group(function () {
    Route::prefix('project-creation-requests')->name('project-creation-requests.')->group(function () {
        Route::get('/', [ProjectCreationRequestController::class, 'index'])->name('index');
        Route::get('/{request}', [ProjectCreationRequestController::class, 'show'])->name('show');
        Route::post('/{request}/approve', [ProjectCreationRequestController::class, 'approve'])->name('approve');
        Route::post('/{request}/reject', [ProjectCreationRequestController::class, 'reject'])->name('reject');
        Route::delete('/{request}', [ProjectCreationRequestController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| force admin dashboard redirect
|--------------------------------------------------------------------------
| Breeze等で /dashboard や /home に返された場合も、常にVoyagerへ寄せる
*/
Route::middleware('web')->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/admin');
    })->name('dashboard');

    Route::get('/home', function () {
        return redirect('/admin');
    })->name('home');
});

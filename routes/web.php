<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DeviceController as AdminDeviceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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


Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/{workspace}/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


// Admin
Route::group(['prefix' => 'admin'], function () {
    // users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{id}/plan', [UserController::class, 'plan'])->name('admin.users.plan');
    Route::get('/users/{id}/workspaces', [UserController::class, 'workspaces'])->name('admin.users.workspaces');

    // admins
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins');

    // devices
    Route::get('/{workspace}/devices', [AdminDeviceController::class, 'index'])->name('admin.devices');
    Route::get('/devices/create', [AdminDeviceController::class, 'create'])->name('admin.devices.create');
    Route::get('/devices/{id}/edit', [AdminDeviceController::class, 'edit'])->name('admin.devices.edit');
    Route::get('/devices/assign', [AdminDeviceController::class, 'assignment'])->name('admin.devices.assignment');

    // logs
    Route::get('/logs', [LogController::class, 'index'])->name('admin.logs');
});

//->middleware('logout.and.redirect');
// Device
Route::get('/{workspace}/devices', [DeviceController::class, 'index'])->name('devices');
Route::get('/{workspace}/devices/create', [DeviceController::class, 'create'])->name('devices.create');
Route::post('/{workspace}/devices/created', [DeviceController::class, 'created']);
Route::post('/{workspace}/devices/createInvitedDevice', [DeviceController::class, 'createInvitedDevice']);
Route::get('/{workspace}/devices/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
Route::post('/{workspace}/devices/{serial}/edit-device', [DeviceController::class, 'editDevice']);
Route::post('/{workspace}/devices/{serial}/edit-trashhold', [DeviceController::class, 'editTrashhold']);
Route::post('/devices/create-device', [DeviceController::class, 'createDevice']);


// Account
Route::get('/{workspace}/account/profile', [AccountController::class, 'account'])->name('account.profile');
Route::get('/{workspace}/account/plan', [AccountController::class, 'plan'])->name('account.plan');
Route::post('/{workspace}/profile/edit-profile', [AccountController::class, 'editProfile']);
Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change.password');


//test

// Zone
Route::get('/{workspace}/zones', [ZoneController::class, 'index'])->name('zones');
Route::get('/{workspace}/zones/create', [ZoneController::class, 'create'])->name('zones.create');
Route::post('zones/{workspace}/created', [ZoneController::class, 'created']);
Route::get('/{workspace}/zones/{id}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
Route::put('/zones/update', [ZoneController::class, 'update']);

// Workspace
Route::get('/{workspace}/settings', [WorkspaceController::class, 'settings'])->name('workspaces.settings');
Route::get('/{workspace}/collaborations', [WorkspaceController::class, 'collaborations'])->name('workspaces.collaborations');
Route::post('/addnewworkspace', [WorkSpaceController::class, 'store']);
Route::get('/', [HomeController::class, 'workspaces'])->name('select-workspace');
Route::post('/{workspace}/workspace/invite-email', [WorkSpaceController::class, 'inviteEmail']);


//Image
Route::controller(ImageController::class)->group(function () {
    Route::get('/image-upload', 'index')->name('image.form');
    Route::post('/upload-image', 'storeImage')->name('image.store');
});


// Report
Route::get('/{workspace}/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/device/{workspace}/reports/{serial}', [ReportController::class, 'deviceReports'])->name('report');


// Issues
Route::get('/{workspace}/issues', [IssueController::class, 'index'])->name('issues');

// Ticket
Route::get('/support', [TicketController::class, 'index'])->name('tickets');
Route::get('/support/create', [TicketController::class, 'create'])->name('tickets.create');
Route::get('/support/{id}', [TicketController::class, 'details'])->name('tickets.details');

// Route::get('/workspaces', [WorkspaceController::class, 'index'])->name('workspaces');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');

// Route::get('/test', function () {
//     return view('demo.test');
// });

Route::group(['prefix' => 'demo'], function () {
    Route::get('/', function () {
        return view('demo.dashboard');
    });

    Route::group(['prefix' => 'email'], function () {
        Route::get('inbox', function () {
            return view('demo.pages.email.inbox');
        });
        Route::get('read', function () {
            return view('demo.pages.email.read');
        });
        Route::get('compose', function () {
            return view('demo.pages.email.compose');
        });
    });

    Route::group(['prefix' => 'apps'], function () {
        Route::get('chat', function () {
            return view('demo.pages.apps.chat');
        });
        Route::get('calendar', function () {
            return view('demo.pages.apps.calendar');
        });
    });

    Route::group(['prefix' => 'ui-components'], function () {
        Route::get('accordion', function () {
            return view('demo.pages.ui-components.accordion');
        });
        Route::get('alerts', function () {
            return view('demo.pages.ui-components.alerts');
        });
        Route::get('badges', function () {
            return view('demo.pages.ui-components.badges');
        });
        Route::get('breadcrumbs', function () {
            return view('demo.pages.ui-components.breadcrumbs');
        });
        Route::get('buttons', function () {
            return view('demo.pages.ui-components.buttons');
        });
        Route::get('button-group', function () {
            return view('demo.pages.ui-components.button-group');
        });
        Route::get('cards', function () {
            return view('demo.pages.ui-components.cards');
        });
        Route::get('carousel', function () {
            return view('demo.pages.ui-components.carousel');
        });
        Route::get('collapse', function () {
            return view('demo.pages.ui-components.collapse');
        });
        Route::get('dropdowns', function () {
            return view('demo.pages.ui-components.dropdowns');
        });
        Route::get('list-group', function () {
            return view('demo.pages.ui-components.list-group');
        });
        Route::get('media-object', function () {
            return view('demo.pages.ui-components.media-object');
        });
        Route::get('modal', function () {
            return view('demo.pages.ui-components.modal');
        });
        Route::get('navs', function () {
            return view('demo.pages.ui-components.navs');
        });
        Route::get('navbar', function () {
            return view('demo.pages.ui-components.navbar');
        });
        Route::get('pagination', function () {
            return view('demo.pages.ui-components.pagination');
        });
        Route::get('popovers', function () {
            return view('demo.pages.ui-components.popovers');
        });
        Route::get('progress', function () {
            return view('demo.pages.ui-components.progress');
        });
        Route::get('scrollbar', function () {
            return view('demo.pages.ui-components.scrollbar');
        });
        Route::get('scrollspy', function () {
            return view('demo.pages.ui-components.scrollspy');
        });
        Route::get('spinners', function () {
            return view('demo.pages.ui-components.spinners');
        });
        Route::get('tabs', function () {
            return view('demo.pages.ui-components.tabs');
        });
        Route::get('tooltips', function () {
            return view('demo.pages.ui-components.tooltips');
        });
    });

    Route::group(['prefix' => 'advanced-ui'], function () {
        Route::get('cropper', function () {
            return view('demo.pages.advanced-ui.cropper');
        });
        Route::get('owl-carousel', function () {
            return view('demo.pages.advanced-ui.owl-carousel');
        });
        Route::get('sortablejs', function () {
            return view('demo.pages.advanced-ui.sortablejs');
        });
        Route::get('sweet-alert', function () {
            return view('demo.pages.advanced-ui.sweet-alert');
        });
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('basic-elements', function () {
            return view('demo.pages.forms.basic-elements');
        });
        Route::get('advanced-elements', function () {
            return view('demo.pages.forms.advanced-elements');
        });
        Route::get('editors', function () {
            return view('demo.pages.forms.editors');
        });
        Route::get('wizard', function () {
            return view('demo.pages.forms.wizard');
        });
    });

    Route::group(['prefix' => 'charts'], function () {
        Route::get('apex', function () {
            return view('demo.pages.charts.apex');
        });
        Route::get('chartjs', function () {
            return view('demo.pages.charts.chartjs');
        });
        Route::get('flot', function () {
            return view('demo.pages.charts.flot');
        });
        Route::get('peity', function () {
            return view('demo.pages.charts.peity');
        });
        Route::get('sparkline', function () {
            return view('demo.pages.charts.sparkline');
        });
    });

    Route::group(['prefix' => 'tables'], function () {
        Route::get('basic-tables', function () {
            return view('demo.pages.tables.basic-tables');
        });
        Route::get('data-table', function () {
            return view('demo.pages.tables.data-table');
        });
    });

    Route::group(['prefix' => 'icons'], function () {
        Route::get('feather-icons', function () {
            return view('demo.pages.icons.feather-icons');
        });
        Route::get('mdi-icons', function () {
            return view('demo.pages.icons.mdi-icons');
        });
    });

    Route::group(['prefix' => 'general'], function () {
        Route::get('blank-page', function () {
            return view('demo.pages.general.blank-page');
        });
        Route::get('faq', function () {
            return view('demo.pages.general.faq');
        });
        Route::get('invoice', function () {
            return view('demo.pages.general.invoice');
        });
        Route::get('profile', function () {
            return view('demo.pages.general.profile');
        });
        Route::get('pricing', function () {
            return view('demo.pages.general.pricing');
        });
        Route::get('timeline', function () {
            return view('demo.pages.general.timeline');
        });
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', function () {
            return view('demo.pages.auth.login');
        });
        Route::get('register', function () {
            return view('demo.pages.auth.register');
        });
    });

    Route::group(['prefix' => 'error'], function () {
        Route::get('404', function () {
            return view('demo.pages.error.404');
        });
        Route::get('500', function () {
            return view('demo.pages.error.500');
        });
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return 'Cache is cleared';
    });

    // 404 for undefined routes
    Route::any('/{page?}', function () {
        return View::make('demo.pages.error.404');
    })->where('page', '.*');
});

Auth::routes();

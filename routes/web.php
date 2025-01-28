<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomOrApartmentController;
use App\Http\Controllers\RoomReservationController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SystemUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/store-login', 'makeAuth')->name('makeAuth');

    Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
    Route::post('/store-forgot-password', 'storeForgotPassword')->name('storeForgotPassword');

    Route::get('/reset-password/{token}', 'resetPassword')->name('resetPassword');
    Route::post('/store-reset-password', 'storeResetPassword')->name('storeResetPassword');
});

Route::middleware('auth')->group(function () {
    Route::controller(RoomTypeController::class)->prefix('/rrs/room-types')->name('rrs.roomType.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
    });
    Route::controller(BedTypeController::class)->prefix('/rrs/bed-types')->name('rrs.bedType.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
    });
    
    Route::controller(FloorController::class)->prefix('/rrs/floors')->name('rrs.floor.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
    Route::controller(SystemUserController::class)->prefix('/system-user')->name('systemUser.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/status/{id}', 'status')->name('status');
        Route::post('/delete/{id}', 'delete')->name('delete');
        Route::post('/rootStatus/{id}', 'rootStatus')->name('rootStatus');
        Route::post('/deleteRootUser/{id}', 'deleteRootUser')->name('deleteRootUser');
    });
    Route::controller(FacilityController::class)->prefix('/rrs/facilities')->name('rrs.facility.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
    });
    Route::controller(RoomOrApartmentController::class)->prefix('/rrs/room-or-apartment')->name('rrs.roa.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/status/{id}', 'status')->name('status');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
    Route::controller(RoomReservationController::class)->prefix('/room-reservation')->name('roomReservation')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
        
        Route::get('/room-reservation-status','roomReservationStatus')->name('roomReservationStatus');
    });
    Route::get('/goto-dashboard', function () {
        $branch_id = request()->branch_id;
        $branch    = Branch::where('owner_id', session('owner_id'))
            ->where('id', $branch_id)
            ->first();

        if ($branch) {
            session()->put('branch_name', $branch->name);
            session()->put('branch_id', $branch->id);
            session()->put('branch_logo', $branch->image);
            session()->put('deadline', $branch->validity);

            $diff = round((strtotime($branch->validity) - strtotime(date("Y-m-d"))) / 86400);
            session()->put('validity_day', $diff);

            $permission = UserPermission::where('user_id', auth()->user()->id)
                ->where('owner_id', session('owner_id'))
                ->where('branch_id', $branch->id)
                ->first();

            session()->put('single_permission', $permission->permission ?? []);

            return response()->json([
                'url' => route('welcome'),
            ]);
        } else {
            auth()->logout();

            return response()->json([
                'url' => route('login'),
            ]);
        }
    })->name('gotoDashboard');

    Route::get('/welcome', [DashboardController::class, 'welcome'])->name('welcome');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



    Route::get('/logout', function (Request $request) {
        auth()->logout();
        $request->session()->flush();
        return to_route('login');
    })->name('logout');
});

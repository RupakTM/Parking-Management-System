<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\ParkingController;
use App\Http\Controllers\Backend\ParkingSlotController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PaymentController;



use App\Http\Controllers\Backend\DashboardController;



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
Route::get('/welcome', function () {
    return view('welcome');
});



Auth::routes([
    'register' => false,
]);
Route::middleware(['web','auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::redirect('/', '/home');
    Route::middleware(['role_permission'])->group(function(){
//    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        //Parking Slot Route
        Route::resource('parkingslot',ParkingSlotController::class);
//      Route::get('parkingslot/create', [ParkingSlotController::class, 'create'])->name('parkingslot.create');
//      Route::post('parkingslot', [ParkingSlotController::class, 'store'])->name('parkingslot.store');
//      Route::get('parkingslot', [ParkingSlotController::class, 'index'])->name('parkingslot.index');
//      Route::get('parkingslot/{id}/edit', [ParkingSlotController::class, 'edit'])->name('parkingslot.edit');
//      Route::put('parkingslot/{id}', [ParkingSlotController::class, 'update'])->name('parkingslot.update');
//      Route::get('parkingslot/{id}', [ParkingSlotController::class, 'show'])->name('parkingslot.show');

        //Parking Route
        Route::get('parking/create', [ParkingController::class, 'create'])->name('parking.create');
        Route::post('parking', [ParkingController::class, 'store'])->name('parking.store');
        Route::get('parking', [ParkingController::class, 'index'])->name('parking.index');
        Route::get('parking/edit', [ParkingController::class, 'edit'])->name('parking.edit');
        Route::post('parking/exit', [ParkingController::class, 'exit'])->name('parking.exit');
        Route::put('parking/{id}', [ParkingController::class, 'update'])->name('parking.update');
        Route::get('parking/invoice', [ParkingController::class, 'invoice'])->name('parking.invoice');
        Route::get('parking/{id}', [ParkingController::class, 'show'])->name('parking.show');


        //User Route
        Route::get('user/trash', [UserController::class, 'trash'])->name('user.trash');
        Route::post('user/{id}/restore', [UserController::class,'restore'])->name('user.restore');
        Route::delete('user/{id}/force-delete',[UserController::class,'forceDelete'])->name('user.forceDelete');
        Route::resource('user',UserController::class);

        //Setting Route
        Route::get('setting/edit', [SettingController::class, 'edit'])->name('setting.edit');
        Route::put('setting/{id}', [SettingController::class, 'update'])->name('setting.update');

        //Role Route
        //ACL
        Route::get('role/assign_permission/{role_id}', [RoleController::class, 'assignPermission'])->name('role.assign_permission');
        Route::post('role/post_permission', [RoleController::class, 'postPermission'])->name('role.post_permission');
        // ACL ends
        Route::get('role/trash', [RoleController::class, 'trash'])->name('role.trash');
        Route::post('role/{id}/restore', [RoleController::class,'restore'])->name('role.restore');
        Route::delete('role/{id}/force-delete',[RoleController::class,'forceDelete'])->name('role.forceDelete');
        Route::resource('role',RoleController::class);

        //Staff Route
        Route::get('staff/trash', [StaffController::class, 'trash'])->name('staff.trash');
        Route::post('staff/{id}/restore', [StaffController::class,'restore'])->name('staff.restore');
        Route::delete('staff/{id}/force-delete',[StaffController::class,'forceDelete'])->name('staff.forceDelete');
        Route::resource('staff',StaffController::class);

        //Customer Route
        Route::resource('customer',CustomerController::class);

        //Payment Route
        Route::post('payment/search', [PaymentController::class, 'search'])->name('payment.search');
        Route::post('payment/reportlist', [PaymentController::class, 'reportlist'])->name('payment.reportlist');

        Route::resource('payment',PaymentController::class);

        //Module Route
        Route::resource('module',ModuleController::class);

        //Permission Route
        Route::resource('permission',PermissionController::class);

//        Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
//        Route::post('permission', [PermissionController::class, 'store'])->name('permission.store');
//        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
//        Route::get('permission/edit', [PermissionController::class, 'edit'])->name('permission.edit');
//        Route::put('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
//        Route::get('permission/{id}', [PermissionController::class, 'show'])->name('permission.show');
//        Route::delete('permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');


    });

//    role_permission middleware ends


//    Route::resource('parking',ParkingController::class);

    //Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    //Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    //Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    //Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');
    //Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    //Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    //Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');



});




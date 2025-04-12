<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\Backend\DTRInternsController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\AssignedInternsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//ADMIN
Route::get(
    '/admin/login',
    [AdminController::class, 'AdminLogin']
)->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes for AdminController
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/update/password', 'AdminUpdatePassword')->name('admin.update.password');
    });
    // Routes for AssignedInternsController
    Route::controller(AssignedInternsController::class)->group(function () {
        Route::get('/interns', 'Interns')->name('interns');
        Route::get('/assign/interns', 'AssignedInterns')->name('assigned.interns');
        Route::post('/store/assign/interns', 'StoreAssignedInterns')->name('store.assigned.interns');
        Route::get('/edit/assign/interns/{id}', 'EditAssignedInterns')->name('edit.assigned.interns');
        Route::put('/update/assign/interns/{id}', 'UpdateAssignedInterns')->name('update.assigned.interns');
        Route::get('/delete/assign/interns/{id}', 'DeleteAssignedInterns')->name('delete.assigned.interns');
    });
    // Routes for ManageUserController
    Route::controller(ManageUserController::class)->group(function () {
        Route::get('/manage/users', 'ManageUsers')->name('manage.users');
        Route::get('/create/users', 'CreateUsers')->name('create.users');
        Route::post('/store/users', 'StoreUsers')->name('store.users');
        Route::get('/edit/user/details/{id}', 'EditUserDetails')->name('edit.user.details');
        Route::put('/update/user/details/{id}', 'UpdateUserDetails')->name('update.user.details');
        Route::get('/delete/user/details/{id}', 'DeleteUserDetails')->name('delete.user.details');
    });
    // Routes for DTRInternsController
    Route::controller(DTRInternsController::class)->group(function () {
        Route::get('/dtr/intern', 'DTRInterns')->name('dtr.intern');
        Route::get('/create/dtr/intern/{assigned_intern_id}', 'CreateDTRInterns')->name('create.dtr.intern');
        Route::post('/store/dtr/intern', 'StoreDTRInterns')->name('store.dtr.intern');
        Route::get('/view/dtr/intern/{id}', 'ViewDTRInterns')->name('view.dtr.intern');
    });
}); //admin middleware

//SUPERVISOR
Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::get(
        '/supervisor/dashboard',
        [SupervisorController::class, 'SupervisorDashboard']
    )->name('supervisor.dashboard');
}); //supervisor middleware
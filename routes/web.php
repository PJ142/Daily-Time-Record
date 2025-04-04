<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupervisorController;
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
    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'AdminDashboard']
    )->name('admin.dashboard');

    Route::get(
        '/admin/logout',
        [AdminController::class, 'AdminLogout']
    )->name('admin.logout');

    Route::get(
        '/admin/profile',
        [AdminController::class, 'AdminProfile']
    )->name('admin.profile');

    Route::post(
        '/admin/profile/store',
        [AdminController::class, 'AdminProfileStore']
    )->name('admin.profile.store');

    Route::get(
        '/admin/change/password',
        [AdminController::class, 'AdminChangePassword']
    )->name('admin.change.password');

    Route::post(
        '/admin/update/password',
        [AdminController::class, 'AdminUpdatePassword']
    )->name('admin.update.password');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AssignedInternsController::class)->group(function () {
        Route::get(
            '/interns', //Route
            'Interns' //Controller
        )->name('interns'); // href
        Route::get(
            '/assign/interns',
            'AssignedInterns'
        )->name('assigned.interns');
        Route::post(
            '/store/assign/interns',
            'StoreAssignedInterns'
        )->name('store.assigned.interns');
        Route::get(
            '/edit/assign/interns/{id}',
            'EditAssignedInterns'
        )->name('edit.assigned.interns');
        Route::put(
            '/update/assign/interns/{id}',
            'UpdateAssignedInterns'
        )->name('update.assigned.interns');
        Route::get(
            '/delete/assign/interns/{id}',
            'DeleteAssignedInterns'
        )->name('delete.assigned.interns');
    });
}); //admin middleware

//SUPERVISOR
Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::get(
        '/supervisor/dashboard',
        [SupervisorController::class, 'SupervisorDashboard']
    )->name('supervisor.dashboard');
}); //supervisor middleware
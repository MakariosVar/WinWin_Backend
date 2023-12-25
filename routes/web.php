<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
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

Route::get('/create-admin', function () {
    $existingAdmin = User::where('role', User::ADMIN)->first();

    if (!$existingAdmin) {
        $admin = new User();
        $admin->username = 'ADMIN';
        $admin->email = 'win@win';
        $admin->password = bcrypt('admin123'); // Hash the password
        $admin->role = User::ADMIN;

        if ($admin->save()) {
            return "Admin user created successfully.";
        } else {
            return "Failed to create admin user.";
        }
    } else {
        return "Admin user already exists.";
    }
});

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('offers', App\Http\Controllers\OfferController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

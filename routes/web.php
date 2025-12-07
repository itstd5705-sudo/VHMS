<?php

use Illuminate\Support\Facades\Route;

//-----------------------------------------------------
// Controllers
//-----------------------------------------------------

// Auth Controllers
use App\Http\Controllers\Auth\authController;

// Employee Controllers
use App\Http\Controllers\Employee\employeeLogin;
use App\Http\Controllers\Employee\PublicBookingController;
use App\Http\Controllers\Employee\CheckListController;

// Doctor Controllers
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\doctorLogin;

// User Controllers
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserPharmacyController;
use App\Http\Controllers\User\cartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserBookingController;

// Visitor Controllers
use App\Http\Controllers\Visitor\departmentViewController;
use App\Http\Controllers\Visitor\CategoryController;
use App\Http\Controllers\Visitor\DoctorController;

// Filament Dashboard
use Filament\Pages\Dashboard as FilamentDashboard;

//-----------------------------------------------------
// Home
//-----------------------------------------------------
Route::get('/', fn() => view('home'))->name('home');

//-----------------------------------------------------
// User Auth
//-----------------------------------------------------
Route::get('/login', [authController::class, 'userLogin'])->name('user.login.form');
Route::post('/login', [authController::class, 'userCheckLogin'])->name('user.login');

Route::get('/register', fn() => view('auth.register'))->name('register.form');
Route::post('/register', [authController::class, 'register'])->name('register');

Route::middleware('auth:web')->post('/logout', [authController::class, 'logout'])->name('logout');

//-----------------------------------------------------
// User Profile + Wallet + Bookings
//-----------------------------------------------------
Route::middleware('auth:web')->group(function () {

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::post('/wallet/charge', [UserController::class, 'chargeWallet'])->name('wallet.charge');

    Route::get('/my-bookings', [UserBookingController::class, 'myBookings'])
        ->name('user.booking.myBookings');

});

//-----------------------------------------------------
// Pharmacy
//-----------------------------------------------------
Route::prefix('pharmacy')->group(function () {

    // Public
    Route::get('/', [UserPharmacyController::class, 'index'])->name('pharmacy.index');
    Route::get('/all', [UserPharmacyController::class, 'allMedications'])->name('pharmacy.all');
    Route::get('/category/{id}', [UserPharmacyController::class, 'showCategory'])->name('pharmacy.category');
    Route::get('/medication/{id}', [UserPharmacyController::class, 'showMedication'])->name('pharmacy.showMedication');
    Route::get('/pharmacy/search', [UserPharmacyController::class, 'search'])->name('pharmacy.search');

    // Requires Auth
    Route::middleware('auth:web')->group(function () {

        Route::get('/cart', [cartController::class, 'index'])->name('pharmacy.cart');
        Route::post('/add-to-cart/{id}', [cartController::class, 'addToCart'])->name('pharmacy.addToCart');
        Route::put('/update-cart/{id}', [cartController::class, 'updateCart'])->name('pharmacy.updateCart');
        Route::delete('/remove-from-cart/{id}', [cartController::class, 'removeFromCart'])->name('pharmacy.removeFromCart');

        // Wallet Checkout
        Route::post('/checkout-wallet', [CartController::class, 'checkoutWallet'])->name('pharmacy.checkoutWallet');
        Route::get('/pharmacy/confirmation', fn() => view('user.pharmacy.confirmation'))->name('pharmacy.confirmation');
        Route::get('/user/my-orders', [CartController::class, 'myOrders'])->name('user.myOrders');

        Route::get('/orders', [OrderController::class, 'orders'])->name('pharmacy.orders');
        Route::get('/checkout', [UserPharmacyController::class, 'checkoutPage'])->name('pharmacy.checkoutPage');
        Route::post('/checkout', [UserPharmacyController::class, 'checkout'])->name('pharmacy.checkout');

    });
});

//-----------------------------------------------------
// Queue Status
//-----------------------------------------------------
Route::get('/queue-status/{appointmentId}', [UserBookingController::class, 'queueStatus'])
    ->name('user.queueStatus');

//-----------------------------------------------------
// Static Pages
//-----------------------------------------------------
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/services', 'services')->name('services');
Route::view('/Analysis', 'Analysis')->name('analyses');

//-----------------------------------------------------
// Doctors (Visitor)
//-----------------------------------------------------
Route::get('/doctors}/{doctor}/appointments-json', [DoctorController::class, 'appointmentsJson']);
Route::get('/doctor/{id}/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctors.search');

//-----------------------------------------------------
// Departments
//-----------------------------------------------------
Route::get('/departments', [departmentViewController::class, 'index'])->name('departments.index');
Route::get('/departments/{id}/doctors', [departmentViewController::class, 'showDoctors'])->name('departments.doctors');

//-----------------------------------------------------
// Filament Admin
//-----------------------------------------------------
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', fn() => redirect('/admin'))->name('admin.dashboard');
});

//-----------------------------------------------------
// Employee
//-----------------------------------------------------
Route::get('/employee/login', [employeeLogin::class, 'showLoginForm'])->name('employee.login');
Route::post('/employee/login', [employeeLogin::class, 'login'])->name('employee.login.post');
Route::post('/employee/logout', [employeeLogin::class, 'logout'])->name('employee.logout');

//-----------------------------------------------------
// Doctor Login + Dashboard
//-----------------------------------------------------
Route::get('/doctor/login', [doctorLogin::class, 'showLoginForm'])->name('doctor.login');
Route::post('/doctor/login', [doctorLogin::class, 'login'])->name('doctor.login.post');
Route::post('/doctor/logout', [doctorLogin::class, 'logout'])->name('doctor.logout');

Route::middleware('auth:doctor')->group(function () {
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
});

//-----------------------------------------------------
// User Appointment Booking
//-----------------------------------------------------
Route::middleware(['auth:web'])->group(function () {

    Route::get('appointment/{id}/book', [UserBookingController::class, 'showBookingForm'])->name('user.book');
    Route::post('appointment/{id}/confirm', [UserBookingController::class, 'confirmBooking'])->name('user.confirmBooking');
    Route::post('wallet/recharge', [UserBookingController::class, 'rechargeWallet'])->name('user.rechargeWallet');

    Route::get('booking/{id}/confirm', [UserBookingController::class, 'bookingConfirm'])->name('user.booking.confirm');
    Route::get('my-bookings', [UserBookingController::class, 'myBookings'])->name('user.booking.myBookings');

    Route::delete('/booking/cancel/{id}', [UserBookingController::class, 'cancelBooking'])
        ->name('booking.cancel');
});

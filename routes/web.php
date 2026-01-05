<?php

use Illuminate\Support\Facades\Route;

//----------------------------
// Controllers Import
//----------------------------
// Auth Controllers
use App\Http\Controllers\Auth\authController;
// Employee Controllers
use App\Http\Controllers\Employee\employeeLogin;
use App\Http\Controllers\Employee\ChecklistController;
// Doctor Controllers
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\doctorLogin;
// User Controllers
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserPharmacyController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserBookingController;
// Visitor Controllers
use App\Http\Controllers\Visitor\departmentViewController;
use App\Http\Controllers\Visitor\DoctorController;
// Filament Dashboard (Admin)
use Filament\Pages\Dashboard as FilamentDashboard;

//----------------------------
// Home Route
//----------------------------
Route::get('/', fn() => view('home'))->name('home');

//----------------------------
// User Authentication
//----------------------------
// صفحة تسجيل دخول المستخدم
Route::get('/login', [authController::class, 'userLogin'])->name('login');
// التحقق من بيانات تسجيل الدخول
Route::post('/login', [authController::class, 'userCheckLogin'])->name('user.login');

// صفحة تسجيل مستخدم جديد
Route::get('/register', fn() => view('auth.register'))->name('register.form');
// عملية التسجيل
Route::post('/register', [authController::class, 'register'])->name('register');

// تسجيل الخروج (يتطلب تسجيل دخول)
Route::middleware('auth:web')->post('/logout', [authController::class, 'logout'])->name('logout');

//----------------------------
// User Profile, Wallet & Bookings
//----------------------------
Route::middleware('auth:web')->group(function () {

    // تعديل بيانات المستخدم
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

    // شحن المحفظة
    Route::post('/wallet/charge', [UserController::class, 'chargeWallet'])->name('wallet.charge');

    // عرض الحجوزات الخاصة بالمستخدم
    Route::get('/my-bookings', [UserBookingController::class, 'myBookings'])
        ->name('user.booking.myBookings');
});

//----------------------------
// Pharmacy Routes
//----------------------------
Route::prefix('pharmacy')->group(function () {

    // ------------------- Public Pharmacy Pages -------------------
    Route::get('/', [UserPharmacyController::class, 'index'])->name('pharmacy.index');
    Route::get('/all', [UserPharmacyController::class, 'allMedications'])->name('pharmacy.all');
    Route::get('/category/{id}', [UserPharmacyController::class, 'showCategory'])->name('pharmacy.category');
    Route::get('/medication/{id}', [UserPharmacyController::class, 'showMedication'])->name('pharmacy.showMedication');
    Route::get('/pharmacy/search', [UserPharmacyController::class, 'search'])->name('pharmacy.search');

    // ------------------- Auth Required -------------------
    Route::middleware('auth:web')->group(function () {

        // سلة التسوق
        Route::get('/cart', [CartController::class, 'index'])->name('pharmacy.cart');
        Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('pharmacy.addToCart');
        Route::put('/update-cart/{id}', [CartController::class, 'updateCart'])->name('pharmacy.updateCart');
        Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('pharmacy.removeFromCart');

        // الدفع باستخدام المحفظة
        Route::post('/checkout-wallet', [CartController::class, 'checkoutWallet'])->name('pharmacy.checkoutWallet');
        Route::get('/pharmacy/confirmation', fn() => view('user.pharmacy.confirmation'))->name('pharmacy.confirmation');

        // عرض الطلبات السابقة للمستخدم
        Route::get('/user/my-orders', [CartController::class, 'myOrders'])->name('user.myOrders');

        // إدارة الطلبات و صفحة الدفع
        Route::get('/orders', [OrderController::class, 'orders'])->name('pharmacy.orders');
        Route::get('/checkout', [UserPharmacyController::class, 'checkoutPage'])->name('pharmacy.checkoutPage');
        Route::post('/checkout', [UserPharmacyController::class, 'checkout'])->name('pharmacy.checkout');
    });
});

//----------------------------
// Queue / Appointment Status
//----------------------------
Route::get('/queue-status/{appointmentId}', [UserBookingController::class, 'queueStatus'])
    ->name('user.queueStatus');

//----------------------------
// Static Pages
//----------------------------
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/services', 'services')->name('services');
Route::view('/Analysis', 'Analysis')->name('analyses');

//----------------------------
// Doctors (Visitor) Routes
//----------------------------
Route::get('/doctors/{doctor}/appointments-json', [DoctorController::class, 'appointmentsJson']);
Route::get('/doctor/{id}/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctors.search');

//----------------------------
// Departments
//----------------------------
Route::get('/departments', [departmentViewController::class, 'index'])->name('departments.index');
Route::get('/departments/{id}/doctors', [departmentViewController::class, 'showDoctors'])->name('departments.doctors');

//----------------------------
// Filament Admin Dashboard
//----------------------------
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', fn() => redirect('/admin'))->name('admin.dashboard');
});

//----------------------------
// User Appointment Booking (Requires Auth)
//----------------------------
Route::middleware(['auth:web'])->group(function () {

    // عرض نموذج الحجز
    Route::get('appointment/{id}/book', [UserBookingController::class, 'showBookingForm'])->name('user.book');

    // تأكيد الحجز
    Route::post('appointment/{id}/confirm', [UserBookingController::class, 'confirmBooking'])->name('user.confirmBooking');

    // شحن المحفظة أثناء الحجز
    Route::post('wallet/recharge', [UserBookingController::class, 'rechargeWallet'])->name('user.rechargeWallet');

    // عرض الحجوزات الخاصة بالمستخدم
    Route::get('my-bookings', [UserBookingController::class, 'myBookings'])->name('user.booking.myBookings');
});

//----------------------------
// Doctor Routes
//----------------------------
// تسجيل الدخول للطبيب
Route::get('/doctor/login', [doctorLogin::class, 'showLoginForm'])->name('doctor.login');
Route::post('/doctor/login', [doctorLogin::class, 'login'])->name('doctor.login.post');
Route::post('/doctor/logout', [doctorLogin::class, 'logout'])->name('doctor.logout');

// مسارات تتطلب تسجيل دخول الطبيب
Route::middleware('auth:doctor')->group(function () {

    // لوحة تحكم الطبيب
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

    // تصدير التقرير المالي العام
    Route::get('/doctor/export-report', [DoctorDashboardController::class, 'exportReport'])->name('doctor.exportReport');

    // صفحة الأرشيف (الحجوزات المؤرشفة)
    Route::get('/doctor/archive', [DoctorDashboardController::class, 'archive'])->name('doctor.archive');

    // إقفال اليوم الحالي
    Route::post('/doctor/close-day', [DoctorDashboardController::class, 'closeDay'])->name('doctor.closeDay');

    // تحديث حالة حجز معين
    Route::post('/doctor/booking/{id}/update-status', [DoctorDashboardController::class, 'updateBookingStatus'])
        ->name('doctor.booking.updateStatus');
});

//----------------------------
// Test Font File Existence
//----------------------------
Route::get('/test-font', function() {
    dd(file_exists(public_path('fonts/cairo/Cairo-Regular.ttf')));
});

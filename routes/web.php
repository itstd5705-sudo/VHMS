<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\authController;

use App\Http\Controllers\Admin\employeeController;
use App\Http\Controllers\Admin\doctorController;
use App\Http\Controllers\Admin\departmentController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\medicationController;
use App\Http\Controllers\Admin\appointmentController;
use App\Http\Controllers\Admin\bookingController;
use App\Http\Controllers\Admin\dashController;
use App\Http\Controllers\Admin\LabController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\DeviceController;

use App\Http\Controllers\Employee\empbookingController;
use App\Http\Controllers\Employee\employeeBookingController;
use App\Http\Controllers\Employee\employeeDashBoardController;
use App\Http\Controllers\Employee\PublicBookingController;

use App\Http\Controllers\Visitor\DepartmentViewController;
use App\Http\Controllers\Visitor\AnalysisController;

use App\Http\Controllers\User\UserPharmacyController;
use App\Http\Controllers\User\cartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\userDoctorController;

//الصفحة الرئيسية
Route::get('/', function () {
    return view('home'); })
    ->name('home');
// صفحة تسجيل دخول المستخدم
Route::get('/login', [authController::class, 'userLogin'])->name('user.login.form');
Route::post('/login', [authController::class, 'userCheckLogin'])->name('user.login');

//انشاء حساب
Route::get('/register', function() { return view('auth.register'); })->name('register.form');
Route::post('/register', [authController::class, 'store'])->name('register');

// User
Route::middleware('auth:web')->group(function (){
// تسجيل الخروج
Route::post('/logout', [authController::class, 'logout'])->name('logout');

// عرض حجوزات المستخدم
Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('user.booking.myBookings');

// صيدلية
Route::prefix('pharmacy')->group(function (){
Route::get('/', [UserPharmacyController::class, 'index'])->name('pharmacy.index');
Route::get('/all', [UserPharmacyController::class, 'allMedications'])->name('pharmacy.all');
Route::get('/category/{id}', [UserPharmacyController::class, 'showCategory'])->name('pharmacy.category');
Route::get('/medication/{id}', [UserPharmacyController::class, 'showMedication'])->name('pharmacy.showMedication');

// سلة
Route::get('/cart', [CartController::class, 'index'])->name('pharmacy.cart');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('pharmacy.addToCart');
Route::put('/update-cart/{id}', [CartController::class, 'updateCart'])->name('pharmacy.updateCart');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('pharmacy.removeFromCart');

// الطلبات
Route::post('/checkout', [OrderController::class, 'checkout'])->name('pharmacy.checkout');
Route::get('/orders', [OrderController::class, 'orders'])->name('pharmacy.orders');

//تاكيد طلب صفحة
Route::get('/pharmacy/checkout', [OrderController::class, 'showCheckout'])->name('pharmacy.showCheckout');
Route::post('/pharmacy/checkout', [OrderController::class, 'checkout'])->name('pharmacy.checkout');

// صفحة تعبئة بيانات الاستلام
Route::get('/checkout', [UserPharmacyController::class, 'checkoutPage'])->name('pharmacy.checkoutPage');

// إرسال الطلب
Route::post('/checkout', [UserPharmacyController::class, 'checkout'])->name('pharmacy.checkout');
});

});

//صفحة تسجيل خروج
Route::middleware('auth')->group(function () {
Route::post('/logout', [authController::class, 'logout'])->name('logout');
});

//ADMIN / DOCTOR / EMPLOYEE (صفحة موحدة)
Route::get('/staff/login', [authController::class, 'staffLogin'])->name('staff.login.form');
Route::post('/staff/login', [authController::class, 'staffCheckLogin'])->name('staff.login');

//LOGOUT
Route::post('/logout', [authController::class, 'logout'])->name('logout');

//صفحة about
Route::get('/about', function () {
return view('about');
})->name('about');

// صفحة contact
Route::get('/contact', function () {
return view('contact');
})->name('contact');

// صفحة service
Route::get('/services', function () {
return view('services');
})->name('services');

//صفحة department
Route::get('/departments', [DepartmentViewController::class, 'index'])->name('departments.index');
Route::get('/departments/{department}', [DepartmentViewController::class, 'show'])->name('departments.show');

//صفحة تحاليل و مختبرات و الاجهزة
Route::get('/Analysis',[AnalysisController::class, 'index'])->name('analyses.index');
//صفحة عرض دكاترة
Route::get('/User/doctor',[userDoctorController::class, 'index'])->name('doctor.index');

// actor admin
Route::middleware('auth:admin')->group( function(){
// صفحة dashboard admin
Route::get('/Admin/dashboard', [dashController::class, 'index'])->name('admin.dashboard');

// Route Admin
Route::resource('employee', employeeController::class)->names([
'index'=>'employee.index',
'create'=>'employee.create',
'store'=>'employee.store',
'edit'=>'employee.edit',
'show'=>'employee.show',
'update'=>'employee.update',
'destroy'=>'employee.destroy',
]);
//
Route::resource('/admin/doctor', doctorController::class)->names([
'index'=>'Admin.doctor.index',
'create'=>'Admin.doctor.create',
'store'=>'Admin.doctor.store',
'edit'=>'Admin.doctor.edit',
'show'=>'Admin.doctor.show',
'update'=>'Admin.doctor.update',
'destroy'=>'Admin.doctor.destroy',
]);
//
Route::resource('department', departmentController::class)->names([
'index'=>'department.index',
'create'=>'department.create',
'store'=>'department.store',
'edit'=>'department.edit',
'show'=>'department.show',
'update'=>'department.update',
'destroy'=>'department.destroy',
]);
//
Route::resource('category',categoryController::class)->names([
'index'=>'category.index',
'create'=>'category.create',
'store'=>'category.store',
'edit'=>'category.edit',
'show'=>'category.show',
'update'=>'category.update',
'destroy'=>'category.destroy',
]);
//
Route::resource('medication',medicationController::class)->names([
'index'=>'medication.index',
'create'=>'medication.create',
'store'=>'medication.store',
'edit'=>'medication.edit',
'show'=>'medication.show',
'update'=>'medication.update',
'destroy'=>'medication.destroy',
]);
//
Route::resource('appointment',appointmentController::class)->names([
'index'=>'appointment.index',
'create'=>'appointment.create',
'store'=>'appointment.store',
'edit'=>'appointment.edit',
'show'=>'appointment.show',
'update'=>'appointment.update',
'destroy'=>'appointment.destroy',
]);
//
Route::resource('/admin/booking', bookingController::class)->names([
'index'=>'Admin.booking.index',
'create'=>'Admin.booking.create',
'store'=>'Admin.booking.store',
'edit'=>'Admin.booking.edit',
'show'=>'Admin.booking.show',
'update'=>'Admin.booking.update',
'destroy'=>'Admin.booking.destroy',
]);
//
Route::resource('/admin/lab', LabController::class)->names([
'index'=>'Admin.lab.index',
'create'=>'Admin.lab.create',
'store'=>'Admin.lab.store',
'edit'=>'Admin.lab.edit',
'show'=>'Admin.lab.show',
'update'=>'Admin.lab.update',
'destroy'=>'Admin.lab.destroy',
]);
//
Route::resource('/admin/Test', TestController::class)->names([
'index'=>'Admin.Test.index',
'create'=>'Admin.Test.create',
'store'=>'Admin.Test.store',
'edit'=>'Admin.Test.edit',
'show'=>'Admin.Test.show',
'update'=>'Admin.Test.update',
'destroy'=>'Admin.Test.destroy',
])->parameters([
'Test' => 'test'
]);
//
Route::resource('/admin/Device', DeviceController::class)->names([
'index'=>'Admin.Device.index',
'create'=>'Admin.Device.create',
'store'=>'Admin.Device.store',
'edit'=>'Admin.Device.edit',
'show'=>'Admin.Device.show',
'update'=>'Admin.Device.update',
'destroy'=>'Admin.Device.destroy',
])
->parameters([
'Device' => 'device'
]);
});

// Employee
Route::middleware('auth:employee')->group( function(){

// صفحة dashboard employee
Route::get('/Employee/dashboard', [employeeDashBoardController::class, 'index'])->name('employee.dashboard');

// حجز بالنسبة للموظف
Route::get('/Employee/booking', [employeeBookingController::class, 'index'])->name('Employee.booking');
//
Route::resource('/Employee/bookings', empbookingController::class)->names([
'index'=>'Employee.booking.index',
'create'=>'Employee.booking.create',
'store'=>'Employee.booking.store',
'edit'=>'Employee.booking.edit',
'show'=>'Employee.booking.show',
'update'=>'Employee.booking.update',
'destroy'=>'Employee.booking.destroy',
]);
// يقبل او يرفض الحجز
Route::post('/Employee/booking/{id}/approve', [employeeBookingController::class, 'approve'])->name('employee.bookings.approve');
Route::post('/Employee/booking/{id}/reject', [employeeBookingController::class, 'reject'])->name('employee.bookings.reject');

// جميع حجوزات مقبولة
Route::get('/public/bookings', [PublicBookingController::class, 'index'])->name('public.bookings.index');
});





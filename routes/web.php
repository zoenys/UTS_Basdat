<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\ConsultationScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\DoctorController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
    // Route untuk menampilkan form register
    Route::get('/register', [SesiController::class, 'showRegisterForm'])->name('register');
    // Route untuk menangani proses register
    Route::post('/register', [SesiController::class, 'register']);
});

// Hanya admin yang bisa mengakses validasi.blade.php
Route::middleware(['auth', 'userakses:admin'])->group(function () {
    Route::get('/admin_validate', [SesiController::class, 'admin_validate'])->name('admin_validate');
    Route::get('/admin_validate', [AdminAppointmentController::class, 'index'])->name('admin.validate');
    Route::post('/admin_validate/{id}/approve', [AdminAppointmentController::class, 'approvePayment'])->name('admin.approve.payment');
    Route::post('/admin_validate/{id}/reject', [AdminAppointmentController::class, 'rejectPayment'])->name('admin.reject.payment');
});

// Hanya psikolog yang bisa mengakses sched.blade.php
Route::middleware(['auth', 'userakses:psikolog'])->group(function () {
    Route::get('/sched', [SesiController::class, 'sched'])->name('psikolog.sched');
});

// Hanya user yang bisa mengakses doctor.blade.php
Route::middleware(['auth', 'userakses:user'])->group(function () {
    Route::get('/doctor', [SesiController::class, 'doctor'])->name('user.doctor');
    Route::get('/doctor', [DoctorController::class, 'doctor'])->name('user.doctor');
});

// Route logout umum
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});

// Default route untuk halaman utama
Route::get('/', function () {
    return view('index');
});

// Route untuk psikolog membuat jadwal


Route::middleware(['auth', 'userakses:psikolog'])->group(function () {
    Route::get('/sched', [ConsultationScheduleController::class, 'index'])->name('psychologist.schedule.index');
    Route::post('/sched', [ConsultationScheduleController::class, 'store'])->name('psychologist.schedule.store');
    Route::get('/sched/{user}', [ConsultationScheduleController::class, 'showPatient'])->name('psychologist.showPatient');

});


Route::middleware(['auth', 'userakses:user'])->group(function () {
    Route::get('/choose-schedule', [AppointmentController::class, 'availableSchedules'])->name('user.schedule.available');
    Route::post('/book-schedule/{id}', [AppointmentController::class, 'book'])->name('user.schedule.book');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('user.appointments.index');
    Route::get('/bayar/{id}', [AppointmentController::class, 'paymentForm'])->name('user.schedule.pay');
    Route::post('/bayar/{id}', [AppointmentController::class, 'processPayment'])->name('user.schedule.processPayment');
    Route::get('/status', [AppointmentController::class, 'paymentStatus'])->name('user.schedule.status');
});





// ///////////////////////////////////

// // Route for the welcome page
// Route::get('/', function () {
//     return view('index');
// });

// // Route for the about page
// Route::get('/about', function () {
//     return view('about');
// });

// // Route for the blog page
// Route::get('/blog', function () {
//     return view('blog');
// });

// // Route for the blog details page
// Route::get('/blog_details', function () {
//     return view('blog_details');
// });

// // Route for the contact page
// Route::get('/contact', function () {
//     return view('contact');
// });

// // Route for processing the contact form (even though there's no database, this is for UI)
// Route::post('/contact_process', function () {
//     return view('contact_process');
// });

// // Route for the department page
// Route::get('/department', function () {
//     return view('department');
// });

// // Route for the doctor page
// Route::get('/doctor', function () {
//     return view('doctor');
// });

// // Route for the elements page
// Route::get('/elements', function () {
//     return view('elements');
// });

// // Route for the chat page
// Route::get('/chat', function () {
//     return view('chat');
// });

// // Route for the payment page
// Route::get('/bayar', function () {
//     return view('bayar'); // Ensure you have a view named 'bayar.blade.php'
// });

// // Route for validation page
// Route::get('/validasi', function () {
//     return view('validasi');
// });
// // Route for the status page
// Route::get('/status', function () {
//     return view('status');
// });

// Route::get('/login', function () {
//     return view('login'); // Make sure you have a login.blade.php file in your views directory
// });

// Route::get('/appointment', function () {
//     return view('appointment'); // Ensure you have a view named 'appointment.blade.php'
// });

// Route::get('/rekam-medis', function () {
//     return view('rekam-medis'); // Ensure the view file is named 'rekam_medis.blade.php'
// });

// Route::get('/sched', function () {
//     return view('sched'); // Ensure the view file is named 'rekam_medis.blade.php'
// });
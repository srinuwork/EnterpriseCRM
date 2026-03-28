<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stats = [
        'clients_count' => \App\Models\Client::count(),
        'products_count' => \App\Models\Product::count(),
        'payments_count' => \App\Models\Payment::count(),
        'total_revenue' => \App\Models\Payment::where('status', 'completed')->sum('amount'),
    ];
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // Security & Logic Controls
    Route::get('/admin/settings', [\App\Http\Controllers\AdminSettingController::class, 'index'])->name('admin.settings');
    Route::patch('/admin/settings', [\App\Http\Controllers\AdminSettingController::class, 'update'])->name('admin.settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('products', ProductController::class);
});

// Admin Only Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('payments', PaymentController::class);
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PostController as PublicPostController;
use App\Http\Controllers\Public\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Admin\OrganizationStructureController;
use App\Http\Controllers\Admin\VillageProfileController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('berita')->name('posts.')->group(function () {
    Route::get('/', [PublicPostController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicPostController::class, 'show'])->name('show');
});

Route::post('/kirim-pesan', [ContactMessageController::class, 'store'])->name('messages.store');

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', AdminPostController::class);
        Route::resource('umkms', AdminUmkmController::class);
        Route::resource('organization-structures', OrganizationStructureController::class);
        Route::resource('contacts', AdminContactController::class);

        Route::get('village-profile', [VillageProfileController::class, 'edit'])->name('village-profile.edit');
        Route::put('village-profile', [VillageProfileController::class, 'update'])->name('village-profile.update');

        Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    });

require __DIR__.'/auth.php';
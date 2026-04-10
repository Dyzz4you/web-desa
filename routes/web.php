<?php

use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\OrganizationStructureController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Admin\NewsAnnouncement;
use App\Http\Controllers\Admin\BudgetReportController as AdminBudgetReportController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\PopulationStatisticController as AdminPopulationStatisticController;
use App\Http\Controllers\Admin\VillageProfileController;
use App\Http\Controllers\Admin\VillageGalleryController;
use App\Http\Controllers\Public\AnnouncementController;
use App\Http\Controllers\Public\BudgetReportController;
use App\Http\Controllers\Public\ContactMessageController;
use App\Http\Controllers\Public\ContactPageController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\PopulationStatisticController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\UmkmController as PublicUmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/tentang-desa', [ProfileController::class, 'about'])->name('about');
    Route::get('/struktur-organisasi', [ProfileController::class, 'organization'])->name('organization');
    Route::get('/peta-desa', [ProfileController::class, 'map'])->name('map');
});

Route::prefix('informasi')->name('information.')->group(function () {
    Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
    Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('announcements.show');
});

Route::get('/apbdes', [BudgetReportController::class, 'index'])->name('budget.index');
Route::get('/umkm', [PublicUmkmController::class, 'index'])->name('public.umkm.index');
Route::get('/data-penduduk', [PopulationStatisticController::class, 'index'])->name('population.index');
Route::get('/kontak', [ContactPageController::class, 'index'])->name('contact.index');

Route::post('/kirim-pesan', [ContactMessageController::class, 'store'])->name('messages.store');

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route::resource('posts', AdminPostController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('announcements', AdminAnnouncementController::class);
        Route::resource('umkms', AdminUmkmController::class);
        Route::resource('organization-structures', OrganizationStructureController::class);
        Route::resource('contacts', AdminContactController::class);
        Route::resource('budget-reports', AdminBudgetReportController::class);
        Route::resource('population-statistics', AdminPopulationStatisticController::class);
        Route::resource('village-galleries', VillageGalleryController::class);

        Route::get('village-profile', [VillageProfileController::class, 'edit'])->name('village-profile.edit');
        Route::put('village-profile', [VillageProfileController::class, 'update'])->name('village-profile.update');

        Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    });

require __DIR__.'/auth.php';
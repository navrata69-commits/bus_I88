<?php

use bus\Project\controllers\Web\AuthController;
use bus\Project\controllers\Web\BusController;
use bus\Project\controllers\Web\DashboardController;
use bus\Project\controllers\Web\DestinationController;
use bus\Project\controllers\Web\FeatureController;
use bus\Project\core\Route;
use bus\Project\controllers\Web\HomeController;
use bus\Project\controllers\Web\ProfileController;
use bus\Project\controllers\Web\PromoController;
use bus\Project\controllers\Web\TourPackageController;
use bus\Project\controllers\Web\TransactionController;

// Route::prefix('/kelas_b/team_1');

Route::get('/', HomeController::class, 'index');

Route::get('/armada-bus', HomeController::class, 'ArmadaBus');

Route::get('/paket-wisata', HomeController::class, 'PaketWisata');

Route::get('/promo', HomeController::class, 'Promo');

Route::get('/tentang-kami', HomeController::class, 'KontakKami');

Route::get('/booking-bus', TransactionController::class, 'indexBus');
Route::post('/booking-bus', TransactionController::class, 'indexBusCreate')->middleware(['auth']);

Route::get('/profile', ProfileController::class, 'index')->middleware(['auth']);
Route::post('/profile/update', ProfileController::class, 'update')->middleware(['auth']);
Route::post('/profile/change-password', ProfileController::class, 'changePassword')->middleware(['auth']);

Route::get('/booking-wisata', TransactionController::class, 'indexTour');
Route::post('/booking-wisata', TransactionController::class, 'storeTour');

Route::get('/pesanan-saya-bus', TransactionController::class, 'pesananSayaBus')->middleware(['auth']);
Route::get('/pesanan-saya-tour', TransactionController::class, 'pesananSayaTour')->middleware(['auth']);

Route::get('/pelunasan-bus/{id}', TransactionController::class, 'pelunasanBus')->middleware(['auth']);
Route::post('/pelunasan/submit', TransactionController::class, 'storePembayaran')->middleware(['auth']);

Route::get('/pelunasan-tour/{id}', TransactionController::class, 'pelunasanTour')->middleware(['auth']);
Route::post('/pelunasan2/submit', TransactionController::class, 'storePembayaranTour')->middleware(['auth']);

Route::get('/transfer-page/{id}', TransactionController::class, 'transferPage')->middleware(['auth']);
Route::post('/pelunasan-upload', TransactionController::class, 'pelunasanUpload')->middleware(['auth']);

Route::get('/login', AuthController::class, 'index');
Route::get('/register', AuthController::class, 'register');
Route::post('/register', AuthController::class, 'createRegister');
Route::post('/login', AuthController::class, 'login');
Route::get('/logout', AuthController::class, 'logout');

Route::get('/dashboard', DashboardController::class, 'index')->middleware(['auth', 'admin']);
Route::post('/dashboard/report', DashboardController::class, 'generateReport')->middleware(['auth', 'admin']);

Route::get('/data-bus', BusController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/add-data-bus', BusController::class, 'add')->middleware(['auth', 'admin']);
Route::post('/add-data-bus', BusController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/edit-bus/{id}', BusController::class, 'edit');
Route::post('/update-data-bus', BusController::class, 'update');
Route::get('/delete-data-bus/{id}', BusController::class, 'delete');

Route::get('/data-destination', DestinationController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/add-destination', DestinationController::class, 'add')->middleware(['auth', 'admin']);
Route::post('/add-destination', DestinationController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/edit-destination/{id}', DestinationController::class, 'edit')->middleware(['auth', 'admin']);
Route::post('/update-destination', DestinationController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/delete-destination/{id}', DestinationController::class, 'delete')->middleware(['auth', 'admin']);

Route::get('/data-promo', PromoController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/add-promo', PromoController::class, 'add')->middleware(['auth', 'admin']);
Route::post('/add-promo', PromoController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/edit-promo/{id}', PromoController::class, 'edit')->middleware(['auth', 'admin']);
Route::post('/update-promo', PromoController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/delete-promo/{id}', PromoController::class, 'delete')->middleware(['auth', 'admin']);

Route::get('/data-promo', PromoController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/add-promo', PromoController::class, 'add')->middleware(['auth', 'admin']);
Route::post('/add-promo', PromoController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/edit-promo/{id}', PromoController::class, 'edit')->middleware(['auth', 'admin']);
Route::post('/update-promo', PromoController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/delete-promo/{id}', PromoController::class, 'delete')->middleware(['auth', 'admin']);

Route::get('/data-fitur-bus', FeatureController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/add-fitur-bus', FeatureController::class, 'add')->middleware(['auth', 'admin']);
Route::post('/add-fitur-bus', FeatureController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/edit-fitur-bus/{id}', FeatureController::class, 'edit')->middleware(['auth', 'admin']);
Route::post('/update-fitur-bus', FeatureController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/delete-fitur-bus/{id}', FeatureController::class, 'delete')->middleware(['auth', 'admin']);

Route::get('/tour-packages', TourPackageController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/tour-packages/add', TourPackageController::class, 'create')->middleware(['auth', 'admin']);
Route::post('/tour-packages/create', TourPackageController::class, 'store')->middleware(['auth', 'admin']);
Route::get('/tour-packages/edit/{id}', TourPackageController::class, 'edit')->middleware(['auth', 'admin']);
Route::post('/tour-packages/update', TourPackageController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/tour-packages/delete/{id}', TourPackageController::class, 'destroy')->middleware(['auth', 'admin']);

Route::get('/bus/belum-konfirmasi', TransactionController::class, 'adminListPembayaranBus')->middleware(['auth', 'admin']);
Route::get('/admin/pembayaran-bus/{id}', TransactionController::class, 'adminDetailPembayaranBus')->middleware(['auth', 'admin']);
Route::get('/confirm/{id}', TransactionController::class, 'konfirmasiPembayaranBus')->middleware(['auth', 'admin']);
Route::get('/tolak/{id}', TransactionController::class, 'tolakPembayaranBus')->middleware(['auth', 'admin']);

Route::get('/bus/konfirmasi', TransactionController::class, 'busAktif')->middleware(['auth', 'admin']);
Route::get('/selesai/{id}', TransactionController::class, 'busSelesai')->middleware(['auth', 'admin']);

Route::get('/riwayat-bus', TransactionController::class, 'riwayatBus')->middleware(['auth', 'admin']);

Route::get('/tour/belum-konfirmasi', TransactionController::class, 'adminListPembayaranTour')->middleware(['auth', 'admin']);
Route::get('/admin/pembayaran-tour/{id}', TransactionController::class, 'adminDetailPembayaranTour')->middleware(['auth', 'admin']);
Route::get('/tour/confirm/{id}', TransactionController::class, 'konfirmasiPembayaranTour')->middleware(['auth', 'admin']);
Route::get('/tour/tolak/{id}', TransactionController::class, 'tolakPembayaranTour')->middleware(['auth', 'admin']);
Route::get('/tour/konfirmasi', TransactionController::class, 'tourAktif')->middleware(['auth', 'admin']);
Route::get('/tour/selesai/{id}', TransactionController::class, 'tourSelesai')->middleware(['auth', 'admin']);
Route::get('/riwayat-tour', TransactionController::class, 'riwayatTour')->middleware(['auth', 'admin']);

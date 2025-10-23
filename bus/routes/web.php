<?php

use bus\Project\controllers\Web\AuthController;
use bus\Project\controllers\Web\BusController;
use bus\Project\controllers\Web\DashboardController;
use bus\Project\controllers\Web\DestinationController;
use bus\Project\controllers\Web\FeatureController;
use bus\Project\core\Route;
use bus\Project\controllers\Web\HomeController;
use bus\Project\controllers\Web\PromoController;
use bus\Project\controllers\Web\TourPackageController;

// Route::prefix('/kelas_b/team_1');

Route::get('/', HomeController::class, 'index')->middleware(['guest']);

Route::get('/armada-bus', HomeController::class, 'ArmadaBus')->middleware(['guest']);

Route::get('/paket-wisata', HomeController::class, 'PaketWisata')->middleware(['guest']);

Route::get('/login', AuthController::class, 'index');
Route::post('/login', AuthController::class, 'login');
Route::get('/logout', AuthController::class, 'logout');

Route::get('/dashboard', DashboardController::class, 'index')->middleware(['auth', 'admin']);

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




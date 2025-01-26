<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\FlowersController::class, 'main'])->name('flowers.main');
Route::get('/index', [\App\Http\Controllers\FlowersController::class, 'index'])->name('lists.index');
Route::get('/flowers/show/{id}', [\App\Http\Controllers\FlowersController::class, 'show'])->name('flowers.show');

//Route::get('/index', function () { return view('lists.index'); })->name('lists.index');
Route::get('/adding', function () { return view('lists.adding'); })->name('lists.adding');


Route::get('/fertilizers/', [\App\Http\Controllers\FertilizersController::class, 'index'])->name('fertilizers.index');
Route::get('/fertilizers/create', [\App\Http\Controllers\FertilizersController::class, 'create'])->name('fertilizers.create');
Route::get('/fertilizers/edit/{id}', [\App\Http\Controllers\FertilizersController::class, 'edit'])->name('fertilizers.edit');
Route::get('/fertilizers/show/{id}', [\App\Http\Controllers\FertilizersController::class, 'show'])->name('fertilizers.show');
Route::post('/fertilizers/store', [\App\Http\Controllers\FertilizersController::class, 'store'])->name('fertilizers.store');
Route::patch('/fertilizers/show/{id}', [\App\Http\Controllers\FertilizersController::class, 'update'])->name('fertilizers.update');
Route::delete('/fertilizers/{id}', [\App\Http\Controllers\FertilizersController::class, 'destroy'])->name('fertilizers.destroy');

Route::get('/soils/', [\App\Http\Controllers\SoilsController::class, 'index'])->name('soils.index');
Route::get('/soils/create', [\App\Http\Controllers\SoilsController::class, 'create'])->name('soils.create');
Route::get('/soils/edit/{id}', [\App\Http\Controllers\SoilsController::class, 'edit'])->name('soils.edit');
Route::get('/soils/show/{id}', [\App\Http\Controllers\SoilsController::class, 'show'])->name('soils.show');
Route::post('/soils/store', [\App\Http\Controllers\SoilsController::class, 'store'])->name('soils.store');
Route::patch('/soils/show/{id}', [\App\Http\Controllers\SoilsController::class, 'update'])->name('soils.update');
Route::delete('/soils/{id}', [\App\Http\Controllers\SoilsController::class, 'destroy'])->name('soils.destroy');

Route::get('/diseases/', [\App\Http\Controllers\DiseasesController::class, 'index'])->name('diseases.index');
Route::get('/diseases/create', [\App\Http\Controllers\DiseasesController::class, 'create'])->name('diseases.create');
Route::get('/diseases/edit/{id}', [\App\Http\Controllers\DiseasesController::class, 'edit'])->name('diseases.edit');
Route::get('/diseases/show/{id}', [\App\Http\Controllers\DiseasesController::class, 'show'])->name('diseases.show');
Route::post('/diseases/store', [\App\Http\Controllers\DiseasesController::class, 'store'])->name('diseases.store');
Route::patch('/diseases/show/{id}', [\App\Http\Controllers\DiseasesController::class, 'update'])->name('diseases.update');
Route::delete('/diseases/{id}', [\App\Http\Controllers\DiseasesController::class, 'destroy'])->name('diseases.destroy');

Route::get('/placements/', [\App\Http\Controllers\PlacementsController::class, 'index'])->name('placements.index');
Route::get('/placements/create', [\App\Http\Controllers\PlacementsController::class, 'create'])->name('placements.create');
Route::get('/placements/edit/{id}', [\App\Http\Controllers\PlacementsController::class, 'edit'])->name('placements.edit');
Route::get('/placements/show/{id}', [\App\Http\Controllers\PlacementsController::class, 'show'])->name('placements.show');
Route::post('/placements/store', [\App\Http\Controllers\PlacementsController::class, 'store'])->name('placements.store');
Route::patch('/placements/show/{id}', [\App\Http\Controllers\PlacementsController::class, 'update'])->name('placements.update');
Route::delete('/placements/{id}', [\App\Http\Controllers\PlacementsController::class, 'destroy'])->name('placements.destroy');

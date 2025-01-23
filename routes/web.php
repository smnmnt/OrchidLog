<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\FlowersController::class, 'main'])->name('flowers.main');
Route::get('/index', [\App\Http\Controllers\FlowersController::class, 'index'])->name('lists.index');

//Route::get('/index', function () { return view('lists.index'); })->name('lists.index');
Route::get('/adding', function () { return view('lists.adding'); })->name('lists.adding');


Route::get('/fertilizers/', [\App\Http\Controllers\FertilizersController::class, 'index'])->name('fertilizers.index');
Route::get('/fertilizers/create', [\App\Http\Controllers\FertilizersController::class, 'create'])->name('fertilizers.create');
Route::get('/fertilizers/edit/{id}', [\App\Http\Controllers\FertilizersController::class, 'edit'])->name('fertilizers.edit');
Route::get('/fertilizers/show/{id}', [\App\Http\Controllers\FertilizersController::class, 'show'])->name('fertilizers.show');
Route::post('/fertilizers/store', [\App\Http\Controllers\FertilizersController::class, 'store'])->name('fertilizers.store');
Route::patch('/fertilizers/show/{id}', [\App\Http\Controllers\FertilizersController::class, 'update'])->name('fertilizers.update');
Route::delete('/fertilizers/{id}', [\App\Http\Controllers\FertilizersController::class, 'destroy'])->name('fertilizers.destroy');

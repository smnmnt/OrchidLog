<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\FlowersController::class, 'main'])->name('flowers.main');

Route::get('/flowers/search', [\App\Http\Controllers\FlowersController::class, 'search'])->name('flowers.search');

Route::get('/watering', [\App\Http\Controllers\FlowersController::class, 'watering_index'])->name('watering.index');
Route::get('/global-watering/create', [\App\Http\Controllers\FlowerWateringsController::class, 'create'])->name('global_watering.create');
Route::get('/global-watering/edit/{id}', [\App\Http\Controllers\FlowerWateringsController::class, 'edit'])->name('global_watering.edit');
Route::get('/global-watering/show/{id}', [\App\Http\Controllers\FlowerWateringsController::class, 'show'])->name('global_watering.show');
Route::post('/global-watering/store', [\App\Http\Controllers\FlowerWateringsController::class, 'store'])->name('global_watering.store');
Route::patch('/global_watering/show/{id}', [\App\Http\Controllers\FlowerWateringsController::class, 'update'])->name('global_watering.update');
Route::delete('/global_watering/{id}', [\App\Http\Controllers\FlowerWateringsController::class, 'destroy'])->name('global_watering.destroy');
Route::delete('/global_watering_link/{WateringId}_{id}', [\App\Http\Controllers\FlowerWateringsController::class, 'destroy_link'])->name('global_watering.destroy_link');

Route::get('/lists/index', [\App\Http\Controllers\FlowersController::class, 'list'])->name('lists.index');
Route::get('/lists/adding', [\App\Http\Controllers\FlowersController::class, 'adding'])->name('lists.adding');

Route::get('flowers/index', [\App\Http\Controllers\FlowersController::class, 'index'])->name('flowers.index');
Route::get('/flowers/create', [\App\Http\Controllers\FlowersController::class, 'create'])->name('flowers.create');
Route::get('/flowers/edit/{id}', [\App\Http\Controllers\FlowersController::class, 'edit'])->name('flowers.edit');
Route::get('/flowers/show/{id}', [\App\Http\Controllers\FlowersController::class, 'show'])->name('flowers.show');
Route::post('/flowers/store', [\App\Http\Controllers\FlowersController::class, 'store'])->name('flowers.store');
Route::patch('/flowers/show/{id}', [\App\Http\Controllers\FlowersController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy'])->name('flowers.destroy');

Route::get('/flowers/create/bloom/{id}', [\App\Http\Controllers\FlowersController::class, 'create_blooms'])->name('flowers.blooms.create');
Route::get('/flowers/edit/bloom/{id}', [\App\Http\Controllers\FlowersController::class, 'edit_blooms'])->name('flowers.blooms.edit');
Route::post('/flowers/store/bloom/{id}', [\App\Http\Controllers\FlowersController::class, 'store_blooms'])->name('flowers.blooms.store');
Route::patch('/flowers/show/bloom/{id}', [\App\Http\Controllers\FlowersController::class, 'update_blooms'])->name('flowers.blooms.update');
Route::delete('/flowers/bloom/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy_blooms'])->name('flowers.blooms.destroy');

//Route::get('/flowers/create/watering/{id}', [\App\Http\Controllers\FlowersController::class, 'create_waterings'])->name('flowers.waterings.create');
//Route::get('/flowers/edit/watering/{id}', [\App\Http\Controllers\FlowersController::class, 'edit_waterings'])->name('flowers.waterings.edit');
//Route::post('/flowers/store/watering/{id}', [\App\Http\Controllers\FlowersController::class, 'store_waterings'])->name('flowers.waterings.store');
//Route::patch('/flowers/show/watering/{id}', [\App\Http\Controllers\FlowersController::class, 'update_waterings'])->name('flowers.waterings.update');
//Route::delete('/flowers/watering/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy_waterings'])->name('flowers.waterings.destroy');

Route::get('/flowers/create/transplanting/{id}', [\App\Http\Controllers\FlowersController::class, 'create_transplantings'])->name('flowers.transplantings.create');
Route::get('/flowers/edit/transplanting/{id}', [\App\Http\Controllers\FlowersController::class, 'edit_transplantings'])->name('flowers.transplantings.edit');
Route::post('/flowers/store/transplanting/{id}', [\App\Http\Controllers\FlowersController::class, 'store_transplantings'])->name('flowers.transplantings.store');
Route::patch('/flowers/show/transplanting/{id}', [\App\Http\Controllers\FlowersController::class, 'update_transplantings'])->name('flowers.transplantings.update');
Route::delete('/flowers/transplanting/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy_transplantings'])->name('flowers.transplantings.destroy');

Route::get('/flowers/create/disease/{id}', [\App\Http\Controllers\FlowersController::class, 'create_diseases'])->name('flowers.diseases.create');
Route::get('/flowers/edit/disease/{id}', [\App\Http\Controllers\FlowersController::class, 'edit_diseases'])->name('flowers.diseases.edit');
Route::post('/flowers/store/disease/{id}', [\App\Http\Controllers\FlowersController::class, 'store_diseases'])->name('flowers.diseases.store');
Route::patch('/flowers/show/disease/{id}', [\App\Http\Controllers\FlowersController::class, 'update_diseases'])->name('flowers.diseases.update');
Route::delete('/flowers/disease/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy_diseases'])->name('flowers.diseases.destroy');

Route::post('/flowers/store/img/{id}', [\App\Http\Controllers\FlowersController::class, 'store_img'])->name('flowers.store_img');
Route::patch('/flowers/show/img/{id}', [\App\Http\Controllers\FlowersController::class, 'update_img'])->name('flowers.update_img_main');
Route::delete('/flowers/img/{id}', [\App\Http\Controllers\FlowersController::class, 'destroy_img'])->name('flowers.destroy_img');

//Route::get('/adding', function () { return view('lists.adding'); })->name('lists.adding');


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

Route::get('/shops/', [\App\Http\Controllers\ShopsController::class, 'index'])->name('shops.index');
Route::get('/shops/create', [\App\Http\Controllers\ShopsController::class, 'create'])->name('shops.create');
Route::get('/shops/edit/{id}', [\App\Http\Controllers\ShopsController::class, 'edit'])->name('shops.edit');
Route::get('/shops/show/{id}', [\App\Http\Controllers\ShopsController::class, 'show'])->name('shops.show');
Route::post('/shops/store', [\App\Http\Controllers\ShopsController::class, 'store'])->name('shops.store');
Route::patch('/shops/show/{id}', [\App\Http\Controllers\ShopsController::class, 'update'])->name('shops.update');
Route::delete('/shops/{id}', [\App\Http\Controllers\ShopsController::class, 'destroy'])->name('shops.destroy');

Route::get('/watering_reqs/', [\App\Http\Controllers\WateringRequirementsController::class, 'index'])->name('watering_reqs.index');
Route::get('/watering_reqs/create', [\App\Http\Controllers\WateringRequirementsController::class, 'create'])->name('watering_reqs.create');
Route::get('/watering_reqs/edit/{id}', [\App\Http\Controllers\WateringRequirementsController::class, 'edit'])->name('watering_reqs.edit');
Route::get('/watering_reqs/show/{id}', [\App\Http\Controllers\WateringRequirementsController::class, 'show'])->name('watering_reqs.show');
Route::post('/watering_reqs/store', [\App\Http\Controllers\WateringRequirementsController::class, 'store'])->name('watering_reqs.store');
Route::patch('/watering_reqs/show/{id}', [\App\Http\Controllers\WateringRequirementsController::class, 'update'])->name('watering_reqs.update');
Route::delete('/watering_reqs/{id}', [\App\Http\Controllers\WateringRequirementsController::class, 'destroy'])->name('watering_reqs.destroy');

Route::get('/top/', [\App\Http\Controllers\TypesOfPlantingController::class, 'index'])->name('top.index');
Route::get('/top/create', [\App\Http\Controllers\TypesOfPlantingController::class, 'create'])->name('top.create');
Route::get('/top/edit/{id}', [\App\Http\Controllers\TypesOfPlantingController::class, 'edit'])->name('top.edit');
Route::get('/top/show/{id}', [\App\Http\Controllers\TypesOfPlantingController::class, 'show'])->name('top.show');
Route::post('/top/store', [\App\Http\Controllers\TypesOfPlantingController::class, 'store'])->name('top.store');
Route::patch('/top/show/{id}', [\App\Http\Controllers\TypesOfPlantingController::class, 'update'])->name('top.update');
Route::delete('/top/{id}', [\App\Http\Controllers\TypesOfPlantingController::class, 'destroy'])->name('top.destroy');

Route::get('/tow/', [\App\Http\Controllers\WateringTypesOfController::class, 'index'])->name('tow.index');
Route::get('/tow/create', [\App\Http\Controllers\WateringTypesOfController::class, 'create'])->name('tow.create');
Route::get('/tow/edit/{id}', [\App\Http\Controllers\WateringTypesOfController::class, 'edit'])->name('tow.edit');
Route::get('/tow/show/{id}', [\App\Http\Controllers\WateringTypesOfController::class, 'show'])->name('tow.show');
Route::post('/tow/store', [\App\Http\Controllers\WateringTypesOfController::class, 'store'])->name('tow.store');
Route::patch('/tow/show/{id}', [\App\Http\Controllers\WateringTypesOfController::class, 'update'])->name('tow.update');
Route::delete('/tow/{id}', [\App\Http\Controllers\WateringTypesOfController::class, 'destroy'])->name('tow.destroy');


Route::get('/wg/', [\App\Http\Controllers\WateringGroupsController::class, 'index'])->name('wg.index');
Route::get('/wg/create', [\App\Http\Controllers\WateringGroupsController::class, 'create'])->name('wg.create');
Route::get('/wg/edit/{id}', [\App\Http\Controllers\WateringGroupsController::class, 'edit'])->name('wg.edit');
Route::get('/wg/show/{id}', [\App\Http\Controllers\WateringGroupsController::class, 'show'])->name('wg.show');
Route::post('/wg/store', [\App\Http\Controllers\WateringGroupsController::class, 'store'])->name('wg.store');
Route::patch('/wg/show/{id}', [\App\Http\Controllers\WateringGroupsController::class, 'update'])->name('wg.update');
Route::delete('/wg/{id}', [\App\Http\Controllers\WateringGroupsController::class, 'destroy'])->name('wg.destroy');

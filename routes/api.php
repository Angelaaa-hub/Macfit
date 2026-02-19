<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::post('/saveRole', [RoleController::class, 'createRole']);
Route::get('/getRoles', [RoleController::class, 'readAllRoles']);
Route::get('/getRole/{id}', [RoleController::class, 'readRole']);
Route::put('/updateRole/{id}', [RoleController::class, 'updateRole']);
Route::delete('/deleteRole/{id}', [RoleController::class, 'deleteRole']);

Route::post('/saveCategory', [CategoryController::class, 'createCategory']);
Route::get('/getCategory', [CategoryController::class, 'readAllCategory']);
Route::get('/getCategory/{id}', [CategoryController::class, 'readCategory']);
Route::put('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

Route::post('/saveGym', [GymController::class, 'createGym']);
Route::get('/getGym', [GymController::class, 'readAllGym']);
Route::get('/getGym/{id}', [GymController::class, 'readGym']);
Route::put('/updateGym/{id}', [GymController::class, 'updateGym']);
Route::delete('/deleteGym/{id}', [GymController::class, 'deleteGym']);

Route::post('/saveBundles', [BundlesController::class, 'createBundles']);
Route::get('/getBundles', [BundlesController::class, 'readAllBundles']);
Route::get('/getBundles/{id}', [BundlesController::class, 'readBundles']);
Route::put('/updateBundles/{id}', [BundlesController::class, 'updateBundles']);
Route::delete('/deleteBundles/{id}', [BundlesController::class, 'deleteBundles']);
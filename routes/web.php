<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [Admin::class, "admin"]);
Route::get('/admin/users', [Admin::class, "adminUsers"]);
Route::get('/admin/news', [Admin::class, "adminNews"]);
Route::get('/admin/users/{id}/edit', [Admin::class, 'editUser']);
Route::put('/admin/users/{id}', [Admin::class, 'updateUser']);
Route::delete('/admin/users/{id}/delete', [Admin::class, 'deleteUser']);
Route::get('/admin/users/create', [Admin::class, 'createUser']);
Route::put('/admin/users/create/true', [Admin::class, 'createUserTrue']);
// Route::get('/test', [Admin::class, "test"]);


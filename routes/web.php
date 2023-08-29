<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class,'home']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', App\Livewire\Dashboard::class)->name('dashboard');

    Route::get('/users', App\Livewire\Users::class)->name('users');
    Route::get('/users/create', App\Livewire\CreateUser::class)->name('create_user');
    Route::get('/users/edit/{user}', App\Livewire\UpdateUser::class)->name('edit_user');

    Route::get('/notes', App\Livewire\Notes::class)->name('notes');
    Route::get('/notes/create', App\Livewire\CreateNote::class)->name('create_note');
    Route::get('/notes/edit/{note}', App\Livewire\UpdateNote::class)->name('edit_note');
    Route::get('/notes/view/{note}', App\Livewire\ViewNote::class)->name('view_note');
});

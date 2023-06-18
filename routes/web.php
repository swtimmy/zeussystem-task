<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TicketManager;
use App\Http\Livewire\TicketDashboard;
use App\Http\Livewire\UserManagement;
use App\Http\Livewire\TicketDetailManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', TicketManager::class)->name('tickets.index');
    Route::get('/user', UserManagement::class)->name('user');    
    Route::get('/ticket-detail/{id}', TicketDetailManagement::class)->name('tickets.detail');
});

// Route::get('/register', function () {
//     return redirect('/');
// });
Route::get('/reset', function () {
    return redirect('/');
});
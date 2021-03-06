<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpCheckerTool;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IpCheckerTool::class, 'index'])->name('home');
Route::post('/', [IpCheckerTool::class, 'addList']);

Route::get('/history', [IpCheckerTool::class, 'history'])->name('history');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

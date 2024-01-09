<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/project', [DataController::class, 'index']);
Route::get('/tambah', [DataController::class, 'create']);
//menyimpan tambah siswa dari form ke db
Route::post('/add-save', [DataController::class, 'store']);
// ambil data yang akan di-update
Route::get('/edit/{project_id}', [DataController::class, 'edit']);
// menyimpan update data
Route::put('/edit-save/{project_id}', [DataController::class, 'update']);
Route::delete('/delete', [DataController::class, 'deletedata'])->name('deletedata');
//cari data
Route::get('/search', [DataController::class, 'searchproject']);
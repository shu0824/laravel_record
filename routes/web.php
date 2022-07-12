<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;

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
Route::group(['middleware '=> ['auth']],function(){

    Route::get('/',[RecordController::class,'index'])->name('record.index');
    Route::post('/',[RecordController::class,'index'])->name('record.index');
    Route::get('/record/addForm',[RecordController::class,'showAddForm'])->name('record.addIndex');
    Route::get('/record/detail/{id}',[RecordController::class,'showDetail'])->name('record.detail');
    Route::post('/record/add',[RecordController::class,'add'])->name('record.add');
    Route::post('/record/updateForm',[RecordController::class,'showUpdateForm'])->name('record.updateIndex');
    Route::get('/record/updateForm',[RecordController::class,'showUpdateForm'])->name('record.updateIndex');
    Route::post('/record/update',[RecordController::class,'update'])->name('record.update');
    Route::post('/record/delete',[RecordController::class,'delete'])->name('record.delete');
    Route::get('/user',[UserController::class,'getName'])->name('getName');
});

require __DIR__.'/auth.php';

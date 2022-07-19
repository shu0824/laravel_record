<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

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
    //一覧画面の表示
    Route::get('/',[RecordController::class,'index'])->name('record.index');
    Route::post('/',[RecordController::class,'index'])->name('record.index');
    //記録の登録画面の表示
    Route::get('/create',[RecordController::class,'create'])->name('record.create');
    //記録の登録処理
    Route::post('/store',[RecordController::class,'store'])->name('record.store');
    //記録の詳細の表示
    Route::get('/show/{id}',[RecordController::class,'show'])->name('record.show');
    //記録の編集画面
    Route::post('/edit',[RecordController::class,'edit'])->name('record.edit');
    //記録の更新処理
    Route::post('/update',[RecordController::class,'update'])->name('record.update');
    //記録の削除処理
    Route::post('/destroy',[RecordController::class,'destroy'])->name('record.destroy');
    //アカウントの詳細画面の表示
    Route::get('/account',[UserController::class,'show'])->name('account.show');
    //全ての記録の削除処理
    Route::post('/allDestroy',[RecordController::class,'allDestroy'])->name('record.allDestroy');
    //アカウントの削除処理
    Route::get('/account/destroy',[UserController::class,'destroy'])->name('account.destroy');
    //アカウント名の取得
    Route::get('/name',[UserController::class,'getName'])->name('getName');
});

require __DIR__.'/auth.php';

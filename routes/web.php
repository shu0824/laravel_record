<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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
    Route::get('/user',[UserController::class,'index'])->name('user.index');
    //全ての記録の削除処理
    Route::post('/allDestroy',[RecordController::class,'allDestroy'])->name('record.allDestroy');
    //アカウントの削除処理
    Route::get('/user/destroy',[UserController::class,'destroy'])->name('user.destroy');
    //アカウント名の取得
    Route::get('/name',[UserController::class,'getName'])->name('getName');
    //ユーザー検索画面の表示
    Route::get('/user/search',[UserController::class,'search'])->name('user.search');
    Route::post('/user/search',[UserController::class,'search'])->name('user.search');
    //ユーザーの公開、非公開状態を変更する処理
    Route::post('/user/privacy',[UserController::class,'privacy'])->name('user.privacy');
    //ユーザーをフォローする
    Route::post('/follow',[FollowController::class,'follow'])->name('follow');
    //フォローしているユーザーを表示
    Route::get('/follow/index',[FollowController::class,'index'])->name('follow.index');
    //フォローしているか確認する処理
    Route::get('/follow/confirm',[FollowController::class,'confirm'])->name('follow.confirm');
    //フォローを解除する処理
    Route::post('/follow/destroy',[FollowController::class,'destroy'])->name('follow.destroy');
});

require __DIR__.'/auth.php';

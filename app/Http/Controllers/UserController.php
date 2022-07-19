<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //アカウント詳細の表示
    public function show()
    {
        return view('account');
    }


    //ユーザー名の取得
    public function getName()
    {
        $userNames = User::where('id',Auth::id())->get('name');
        foreach($userNames as $userName)
         session()->put('user_name',$userName->name);

         return redirect()->route('record.index');
    }


    //アカウントの削除処理
    public function destroy()
    {
        User::where('name',session('user_name'))->delete();
        return view('destroyMessage',[
            'message' => 'アカウントを削除しました'
        ]);
    }
}

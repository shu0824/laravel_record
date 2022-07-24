<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //アカウント詳細の表示
    public function index()
    {
        if(session('user_id') != Auth::id()){
            $userNames = User::where('id',Auth::id())->get('name');
            foreach($userNames as $userName)
            session()->put('user_name',$userName->name);
            session()->put('user_id',Auth::id());

            if(session('follow')){
                session()->forget('follow');
            }
        }
        return view('user.index');
    }


    //自分のユーザー名の取得
    public function getName()
    {
        $userNames = User::where('id',Auth::id())->get('name');
        foreach($userNames as $userName)
         session()->put('user_name',$userName->name);
         session()->put('user_id',Auth::id());

         return redirect()->route('record.index');
    }

    //検索したユーザー名の表示
    public function search(Request $request)
    {
        $userName = User::where('name',$request->name)->get();
        if(isset($userName)){
            return view('user.search',[
                'userName' => $userName
            ]);
        }
    }

    //アカウントの削除処理
    public function destroy()
    {
        User::where('name',session('user_name'))->delete();
        return view('destroyMessage',[
            'message' => 'アカウントを削除しました'
        ]);
    }

    public function getUser()
    {

    }
}

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
        $users = User::where('id',Auth::id())->get();
        foreach($users as $user){
            $privacy = $user->privacy;
        }
        return view('user.index',[
            'privacy' => $privacy,
        ]);
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
        $userName = User::where('name',$request->name)->where('privacy','public')->get();
        if(isset($userName)){
            return view('user.search',[
                'userName' => $userName
            ]);
        }
    }

    public function privacy(Request $request)
    {
        if($request->privacy == 'bePrivate'){
            User::find(Auth::id())->update([
                'privacy' => 'private'
            ]);
        }elseif($request->privacy == 'bePublic'){
            User::find(Auth::id())->update([
                'privacy' => 'public'
            ]);
        }
        return redirect()->route('user.index');
    }

    //アカウントの削除処理
    public function destroy()
    {
        User::where('name',session('user_name'))->delete();
        session()->flush();
        return 'アカウントを削除しました';
    }

}

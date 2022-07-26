<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Http\Controllers\RecordController;

class FollowController extends Controller
{
    //ユーザーをフォローする処理
    public function follow()
    {
        Follow::create([
            'from' => Auth::id(),
            'for' =>  session('user_id'),
            'name' => session('user_name')
        ]);

        session()->put('follow','follow');

        return redirect()->route('record.index')->with('message','フォローしました');
    }

    //フォローユーザーを表示
    public function index()
    {
        $followUsers = Follow::where('from',Auth::id())->get();

        return view('user.follow',[
            'followUsers' => $followUsers
        ]);
    }

    //フォローしているか確認する処理
    public function confirm()
    {
        if(Follow::where('from',Auth::id())->where('for',session('user_id'))->exists()){
            session()->put('follow','follow');
        }
        return redirect()->route('record.index');
    }

    //フォローを外す処理
    public function destroy()
    {
        Follow::where('from',Auth::id())->where('for',session('user_id'))->delete();
        session()->forget('follow');

        return redirect()->route('record.index');
    }
}

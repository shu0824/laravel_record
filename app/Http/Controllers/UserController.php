<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getName()
    {
        $userNames = User::where('id',Auth::id())->get('name');
        foreach($userNames as $userName)
         session()->put('user_name',$userName->name);

         return redirect()->route('record.index');
    }
}

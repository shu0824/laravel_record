<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

class RecordController extends Controller
{
    //一覧画面の表示
    public function index(Request $request)
    {
        // session()->forget('follow');
        if(!Auth::id()){
            return redirect()->route('login');
        }

        //他のユーザーが閲覧した場合の処理
        if(isset($request->id)){
            session()->forget('select_category');
            session()->put('user_id',$request->id);
            session()->put('user_name',$request->name);
            session()->put('before',$request->before);

            return redirect()->route('follow.confirm');
        }


        $categories = Record::where('user_id',session('user_id'))->groupBy('category')->get('category');
        session()->put('categories',$categories);

        if($request->category){
            session()->remove('select_category');
            session()->put('select_category',$request->category);
        }else{
            //データがあるか確認
            $records = Record::where('user_id',session('user_id'))->first();
            if($records){
                if(!session('select_category')){
                    session()->put('select_category', $categories[0]['category']);
                }
            }else{
                if(session('select_category')){
                    session()->forget('select_category');
                }
            }
        }

        //並び替え
        if($request->order){
            session()->put('select_order',$request->order);
            switch ($request->order){
                case '評価順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('point','desc')->get();
                break;
                case '新しい順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('created_at','desc')->get();
                break;
                case '古い順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('created_at','asc')->get();
                break;}
            }elseif(session('select_order')){
            switch (session('select_order')){
                case '評価順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('point','desc')->get();
                break;
                case '新しい順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('created_at','desc')->get();
                break;
                case '古い順';
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('created_at','asc')->get();
                break;}
            }else{
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->orderBy('created_at','desc')->get();
                session()->put('select_order','新しい順');
            }

            if($request->search_title){
                $records = Record::where('user_id',session('user_id'))->where('category',session('select_category'))->where('title','like','%'.$request->search_title.'%')->orderBy('updated_at','desc')->get();
            }

            return view('record.index',[
                'name' => $this->getLoginUserName(),
                'records' => $records,
                'categories' => $categories,
            ]);
        }

    //詳細の表示
    public function show($id)
    {
        $records = Record::where('id',$id)->get();
        session()->put('select_id', $id);

        return view('record.show',[
            'records' => $records,
        ]);
    }


    // 追加画面の表示
    public function create()
    {
        return view('record.create');
    }


    // 編集画面の表示
    public function edit()
    {
        $records = Record::where('id',session('select_id'))->get();

        return view('record.edit',[
            'records' => $records,
        ]);
    }


    // 追加処理
    public function store(Request $request)
    {
        $request->validate([
                'title' => ['required', 'max:25'],
                'category' => ['required', 'max:10']
            ]);
            //画像ファイルがある場合
            if($request->image){

                $image = $request->file('image');
                $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
                $image_path = Storage::disk('s3')->url($path);

                if($image_path){
                    Record::create([
                        'user_id' => Auth::id(),
                        'title' => $request->title,
                        'point' => $request->point,
                        'image_path' => $image_path,
                        'content' => $request->content,
                        'category' => $request->category,
                    ]);
                }
            //画像ファイルがない場合
            }else{
                Record::create([
                    'user_id' => Auth::id(),
                    'title' => $request->title,
                    'point' => $request->point,
                    'content' => $request->content,
                    'category' => $request->category,
                ]);
            }
            return redirect()->route('record.index')->with('message','追加しました');
        }


    // 更新処理
    public function update(Request $request)
    {
        $record = Record::find(session('select_id'));

        $request->validate([
            'title' => ['required', 'max:25'],
            'category' => ['required', 'max:10']
        ]);

        $record->update([
            'title' => $request->title,
            'point' => $request->point,
            'content' => $request->content,
            'category' => $request->category,
        ]);
        if($request->hasFile('image')){
                $image = $request->file('image');
                Storage::disk('s3')->delete($image);
                $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
                $image_path = Storage::disk('s3')->url($path);
                $record->update([
                    'image_path' => $image_path,
                ]);
            }
        return redirect()->route('record.show',session('select_id'));
    }


    // 削除処理
    public function destroy()
    {
        Record::find(session('select_id'))->delete();
        session()->remove('select_id');

        return redirect()->route('record.index')->with('message','削除しました');
    }


    //削除処理（全削除）
    public function allDestroy()
    {
        Record::where('user_id',Auth::id())->delete();
        return redirect()->action([UserController::class,'destroy']);
    }


    // ユーザー名取得
    private function getLoginUserName() {
        $user = Auth::user();

        $name = '';
        if ($user) {
            if (7 < mb_strlen($user->name)) {
                $name = mb_substr($user->name, 0, 7) . "...";
            } else {
                $name = $user->name;
            }
        }

        return $name;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecordRequest;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    // ページ表示
    // --start--
    public function index(Request $request)
    {
        if(!Auth::id()){
            return redirect()->route('login');
        }

        $categories = Record::where('user_id',Auth::id())->groupBy('category')->get('category');
        session()->put('categories',$categories);

            if($request->category){
                session()->remove('select_category');
                session()->put('select_category',$request->category);
            }else{
                //データがあるか確認
                $records = Record::where('user_id',Auth::id())->first();
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
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('point','desc')->get();
                break;
                case '新しい順';
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('created_at','desc')->get();
                break;
                case '古い順';
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('created_at','asc')->get();
                break;}
            }elseif(session('select_order')){
            switch (session('select_order')){
                case '評価順';
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('point','desc')->get();
                break;
                case '新しい順';
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('created_at','desc')->get();
                break;
                case '古い順';
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('created_at','asc')->get();
                break;}
            }else{
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->orderBy('updated_at','desc')->get();
            }

            if($request->search_title){
                $records = Record::where('user_id',Auth::id())->where('category',session('select_category'))->where('title','like','%'.$request->search_title.'%')->orderBy('updated_at','desc')->get();
            }

        return view('index',[
            'name' => $this->getLoginUserName(),
            'records' => $records,
            'categories' => $categories,
        ]);
    }

    //詳細
    public function showDetail($id)
    {
        $records = Record::where('id',$id)->get();
        session()->put('select_id', $id);

        return view('detail',[
            'records' => $records,
        ]);
    }
    // 追加フォーム
    public function showAddForm()
    {
        return view('add');
    }
    // 更新フォーム
    public function showUpdateForm()
    {
        $records = Record::where('id',session('select_id'))->get();

        return view('update',[
            'records' => $records,
        ]);
    }
    // --end--

    // 機能
    // --start--
    // 追加
    public function add(Request $request)
    {
        $request->validate([
                'title' => ['required', 'max:25'],
                'category' => ['required', 'max:10']
            ]);

            Record::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'point' => $request->point,
                'content' => $request->content,
                'category' => $request->category,
            ]);

            if($request->image){
                $image = $request->file('image');
                $path = $image->store('img','public');
                if($path){
                    Record::where('title',$request->title)->update([
                        'image' => $path,
                    ]);
                }
            }else{
                Record::where('title',$request->title)->update([
                    'image' => 'img/ya8lCdOabnqQjlBHcVcAZvcgsiHzw6H1g4I3NTYc.jpg',
                ]);
            }


            return redirect()->route('record.index');
        }
    // 更新
    public function update(Request $request)
    {
        $record = Record::find(session('select_id'));

        $request->validate([
            // 'title' => ['required', 'max:25', 'unique:records,title,'.session('select_id')],
            'title' => ['required', 'max:25'],
            'category' => ['required', 'max:10']
        ]);

        $record->update([
            'title' => $request->title,
            'point' => $request->point,
            'content' => $request->content,
            'category' => $request->category,
        ]);
        if($request->image){
            if($request->image !== $record->image){
                $image = $request->file('image');
                $path = $image->store('img','public');
                if($path){
                    $record->update([
                        'image' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('record.detail',session('select_id'));
    }
    // 削除
    public function delete()
    {
        Record::find(session('select_id'))->delete();
        session()->remove('select_id');

        return redirect()->route('record.index');
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
    // --end--
}

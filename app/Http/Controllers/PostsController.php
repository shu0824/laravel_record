<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
public function index(Request $request)
{
    $posts = Post::all();

    return view('PostIndex', ['posts' => $posts]);
}
  public function add()
  {
      return view('posts.create');
  }

  public function create(Request $request)
  {
      $post = new Post;
      $form = $request->all();

      //s3アップロード開始
      $image = $request->file('image');
      var_dump($image);
      // バケットの`myprefix`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
      dd($path);
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);

      $post->save();

      return redirect()->route('record.index');
  }
}

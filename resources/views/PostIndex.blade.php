<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($posts as $post)
    @if ($post->image_path)
      <!-- 画像を表示 -->
      <img src="{{ $post->image_path }}">
    @endif
  @endforeach
</body>
</html>
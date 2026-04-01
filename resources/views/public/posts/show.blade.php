<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->excerpt }}</p>
    <div>
        {!! nl2br(e($post->content)) !!}
    </div>

    <h3>Berita Terkait</h3>
    @foreach ($relatedPosts as $item)
        <p>
            <a href="{{ route('posts.show', $item->slug) }}">{{ $item->title }}</a>
        </p>
    @endforeach
</body>
</html>
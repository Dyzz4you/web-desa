<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
</head>
<body>
    <h1>Daftar Berita</h1>

    @foreach ($posts as $post)
        <div style="margin-bottom: 20px;">
            <h3>
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            <p>{{ $post->excerpt }}</p>
        </div>
    @endforeach

    {{ $posts->links() }}
</body>
</html>
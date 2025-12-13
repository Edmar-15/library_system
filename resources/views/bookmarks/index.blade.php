<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bookmarks.css') }}">
</head>
<body>
@section('content')
<div class="container">

    <h2>Your Bookmarks</h2>

    @if ($bookmarks->isEmpty())
        <p>No bookmarks yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Last Page</th>
                    <th>Continue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookmarks as $bookmark)
                    <tr>
                        <td>{{ $bookmark->book->title }}</td>
                        <td>{{ $bookmark->last_page }}</td>
                        <td>
                            <a href="{{ route('books.readbook', ['book' => $bookmark->book->id, 'page' => $bookmark->last_page]) }}"
                               class="btn btn-primary btn-sm">
                                Continue Reading
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
        <a href="{{ route('show.home') }}">Back to the future</a>
        <a href="{{ route('booklists.index') }}">Back to booklists</a>

</div>

</body>
</html>
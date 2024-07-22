<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit post</title>
</head>
<body>
    <h1>Edit post</h1>
    <div>
        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form action="/edit-post/{{$blogpost->id}}" method="post">
        @csrf
        @method('put')

        <input type="text" name="title" value="{{$blogpost->title}}">
        <textarea name="body" id="" cols="30" rows="10">{{$blogpost->body}}</textarea>

        <button>Save Changes</button>
    </form>
</body>
</html>
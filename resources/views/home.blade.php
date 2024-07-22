<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>

    @auth
        <h2>Logged In</h2>
        <form action="/logout" method="post">
            @csrf
            <button>Logout</button>
        </form>

        {{-- Create a post --}}
        <div style="border: 3px solid black; margin-top: 30px">
            <h2>Post something!</h2>

            @if (session('sucess'))
                <p>
                    {{ session('sucess') }}
                </p>
            @endif



            <form action="/post" method="POST">
                @csrf

                <div>
                    <Label>Title</Label>
                    <input type="text" name="title" placeholder="Title">
                </div>

                <div style="margin-top: 10px;">
                    <Label>Body</Label>
                    <textarea type="text" name="body" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                </div>

                <button>Post</button>
            </form>
        </div>

        <div style="border: 3px solid black; marging-top: 15px">
            <h2>All post</h2>
            @foreach ($blogposts as $blogpost)
                <div style="margin: 15px; background-color:gray; padding: 10px">
                    <h2>{{$blogpost['title']}}</h2>
                    <p>{{$blogpost['body']}}</p>

                    <a href="/edit-post/{{$blogpost->id}}"><button>Edit</button></a>
                    <form action="/delete-post/{{$blogpost->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black">
            <h2>Create An Account</h2>
            <form method="POST" action="/register">
                @csrf

                <div style="margin-top: 2px">
                    <Label>Name</Label>
                    <input type="text" name="name" placeholder="Name">
                </div>

                <div style="margin-top: 2px">
                    <Label>Email</Label>
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div style="margin-top: 2px">
                    <Label>Password</Label>
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

        <div style="border: 3px solid black; margin-top: 10px">
            <h2>Login</h2>
            <form method="POST" action="/login">
                @csrf

                <div style="margin-top: 2px">
                    <Label>Email</Label>
                    <input type="email" name="loginemail" placeholder="Email">
                </div>

                <div style="margin-top: 2px">
                    <Label>Password</Label>
                    <input type="password" name="loginpassword" placeholder="Password">
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>
    @endauth



</body>

</html>

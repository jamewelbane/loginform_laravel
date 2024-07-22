<?php

namespace App\Http\Controllers;


use App\Models\Blogpost;
use Illuminate\Http\Request;

class PostController extends Controller
{   

    public function deletePost(Blogpost $blogpost) {
        if (auth()->user()->id !== $blogpost['user_id']) {
            
        }
        
        

        if ($blogpost->delete()) {
            return redirect('/');
        }
    }

    public function updatePost(Blogpost $blogpost, Request $request)
    {
        if (auth()->user()->id !== $blogpost['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $blogpost->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Blogpost $blogpost)
    {

        if (auth()->user()->id !== $blogpost['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['blogpost' => $blogpost]);
    }

    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Blogpost::create($incomingFields);

        return redirect('/')->with('success', 'Your new post has finished uploading!');
    }
}

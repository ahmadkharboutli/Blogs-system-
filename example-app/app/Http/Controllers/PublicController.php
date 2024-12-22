<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postsFromDB = Post::all();
    return view('PublicPosts.allPosts', ['posts' => $postsFromDB] );
    }
    public function public()
    {
        $postsFromDB = Post::all();
    return view('welcome', ['posts' => $postsFromDB] );
    }
    public function comment(Post $post, Request $request)
{
    // $post = Post::find($postId);
    request()-> validate([
        'comment'=> ['required','min:3','max:50']]);

$commentEnter = request()->comment;


$comments = $post->comment($commentEnter);
$comments->approve();


    // Store the comments in the session
    
    return redirect()->route('PublicPosts.allPosts', ['post' => $post->id]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
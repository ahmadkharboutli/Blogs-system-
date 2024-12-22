<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class PostsController extends Controller
{
    public function index(Request $request)
    {
        //select * from posts;
        // $postsFromDB = Post::all();//collection object
        $sortField = $request->get('sort_field', 'created_at'); // Default sort field
        $sortOrder = $request->get('sort_order', 'asc'); // Default sort order

        $posts = Post::orderBy($sortField, $sortOrder)->get();
        $admins = Admin::all();
        $users = User::all();
        return view('Posts.index', compact('posts', 'admins', 'users', 'sortField', 'sortOrder'));
    }
    public function managePosts(Request $request)
    {
        //select * from posts;
        // $postsFromDB = Post::all();//collection object
        $sortField = $request->get('sort_field', 'created_at'); // Default sort field
        $sortOrder = $request->get('sort_order', 'asc'); // Default sort order

        $posts = Post::orderBy($sortField, $sortOrder)->get();
        $users = User::orderBy($sortField, $sortOrder)->get();
        return view('Posts.manage', compact('posts', 'sortField', 'sortOrder', 'users'));
    }
    public function show(Post $post)//type hinting
    {
        //select * from posts where id = $postId;
        // $singlePostsFromDB = Post::findOrFail($postId);
        $comments = $post->comments;

        // Store the comments in the session
        session()->flash('comments', $comments);

        return view('Posts.show', ['post' => $post], ['comments' => $comments]);

    }
    public function allPosts()//type hinting
    {
        //select * from posts where id = $postId;

        $postsFromDB = Post::all();//collection object
        return view('Posts.allPosts', ['posts' => $postsFromDB]);

    }
    public function create(Post $post)
    {
        $admins = Admin::all();
        return view('Posts.create', ['admins' => $admins], ['post' => $post]);

    }
    public function edit(Post $post)
    {
        $admins = Admin::all();
        return view('Posts.edit', ['admins' => $admins], ['post' => $post]);

    }
    public function update($postId)
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:40'],
            'description' => ['required', 'min:6',],
            'post_creator' => ['required', 'exists:admins,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $singlePostsFromDB = Post::find($postId);
        $singlePostsFromDB->update([
            'title' => $title,
            'description' => $description,
            'admin_id' => $postCreator,
        ]);
        return to_route(route: 'posts.show', parameters: $postId);

    }

    public function store()
    {
        request()->validate(['title' => ['required', 'min:3', 'max:40', 'string'], 'description' => ['required', 'min:6', 'string'], 'post_creator' => ['required', 'exists:users,id']]);
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', storage_path('app/cache/htmlpurifier'));
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify(request()->input('description'));
        Post::create(['title' => request()->title, 'description' => $clean_html, 'admin_id' => request()->post_creator]);
        return redirect()->route('posts.index');
    }
    public function destroy($postId)
    {
        $singlePostsFromDB = Post::find($postId);
        $singlePostsFromDB->delete();
        //  Post::where('title','chemistw')->delete(); NO model event
        return to_route(route: 'posts.manage');
    }
    public function trash()
    {
        $postsFromDB = Post::all();//collection object
        $deletedPosts = Post::onlyTrashed()->get();

        return view('Posts.trash', ['posts' => $postsFromDB], ['deletePosts' => $deletedPosts]);
    }
    public function restore($postId)
    {
        $data = Post::withTrashed()->find($postId);//collection object
        $data->restore();

        return to_route(route: 'posts.trash');
    }
    public function forceDelete($postId)
    {
        $post = Post::withTrashed()->find($postId);
        $post->forceDelete();

        return to_route(route: 'posts.trash');
    }
    public function sortByDate(Request $request)
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }
    public function getData()
    {
        $posts = DB::table('posts')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as post_count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $users = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as monthUser'), DB::raw('count(*) as user_count'))
            ->groupBy('monthUser')
            ->orderBy('monthUser')
            ->get();

        $data = [
            'posts' => $posts,
            'users' => $users
        ];

        return response()->json($data);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }
    public function searchPosts(Request $request)
    {
        $this ->validate($request, [
                'query' => 'required',
        ]);
        $query = $request->input('query');
        $posts = Post::where('title', $query)->orWhere('body', '%'.$query.'%')->get();
        //$posts = Post::select('SELECT * FROM posts WHERE title LIKE ?', $query)->get()->toArray();
        
        //DB::connection()->enableQueryLog();

        //$wut = Post::getQueryLog();
        info($posts);
        return view('dashboard')->with('posts', $posts);
    }
}

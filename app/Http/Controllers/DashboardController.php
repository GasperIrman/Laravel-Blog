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
    
        if($user->admin == true){
            $posts = Post::all();
        }
        else{
            $posts = $user->posts;
        }
        
        return view('dashboard')->with('posts', $posts);
    }
        public function searchPosts(Request $request)
    {
        $this ->validate($request, [
                'query' => 'required',
        ]);
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', '%'.$query.'%')->orWhere('body', 'LIKE', '%'.$query.'%')->get();
        info($posts);
        return view('dashboard')->with('posts', $posts);
    }

}

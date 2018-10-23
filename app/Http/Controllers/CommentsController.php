<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'comment' => 'required|max:200'
        ));

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->post_id;

        $comment->save();
        return redirect('/posts/'.$request->post_id)->with('success', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Don't need this / maybe later
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Don't need this
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Don't need this
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if($comment->user_id === auth()->user() ->id || auth()->user()->admin)
        {
            $comment->delete();
            return redirect('/posts/'.$comment->post_id)->with('success', 'Comment deleted successfully');
        }
        return redirect('/posts/'.$comment->post_id)->with('error', 'Alo da nebi slučajno');
    }
}

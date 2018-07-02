<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \Session;
use App\Http\Requests;
use App\{Comment,Post,Photo};

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();

        return view('admin.comments.index',compact('comments'));
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
        //
        $user = Auth::user();
        //$content = $request->all();
        $commentAttr = [
            'post_id' => $request->post_id,
            'author'=> $user->name,
            'email' => $user->email,
            'photo' => $user->photo ? $user->photo->file : Photo::getPlaceHolder(),
            'body' => $request->body
        ];

        $comment = Comment::create($commentAttr);

        $request->session()->flash('comment_add','Your Comment has been Added to this Post');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        $comments = $post->comments;

        return view('admin.comments.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $comment = Comment::findOrFail($id);

        $comment->update($request->all());

        $flashMessage = 'Comment ' . $comment->id . ' has been ';
        $component = ($request->is_active ? 'approved' : 'unapproved');
        $flashMessage = $flashMessage . $component;
        Session::flash($request->is_active ? 'comment_approve' : 'comment_disapprove',$flashMessage);

        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::findOrFail($id);


        Session::flash('comment_delete','Comment Record ' . $id . ' has been removed');
        $comment->delete();

        return redirect()->back();
    }
}

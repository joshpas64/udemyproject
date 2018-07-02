<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Session;

use App\Http\Requests;

use App\{Comment,CommentReply};

class CommentRepliesController extends Controller
{
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
        //
    }

    public function createReply(Request $request){
        $user = Auth::user();

        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo ? $user->photo->file : Photo::getPlaceHolder(),
            'body' => $request->body
        ];

        $reply = CommentReply::create($data);
        //dd($reply);
        Session::flash('reply_add','Your reply has been added');

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
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;


        return view('admin.comments.replies.show',compact('comment','replies'));
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
        $reply = CommentReply::findOrFail($id);

        $reply->update($request->all());

        $flashMessage = 'Your Reply ' . $reply->id . ' has been ';
        $component = ($request->is_active ? 'approved' : 'unapproved');
        $flashMessage = $flashMessage . $component;
        Session::flash($request->is_active ? 'reply_approve' : 'reply_disapprove',$flashMessage);


        return redirect()->back();
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
        $reply = CommentReply::findOrFail($id);

        $reply->delete();

        Session::flash('reply_delete','Your reply has been removed');

        return redirect()->back();
    }
}

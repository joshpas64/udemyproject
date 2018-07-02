<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User,Post,Comment,CommentReply,Category,Photo};

class AdminController extends Controller
{
    //
    public function index(){
    	$userCount     = count(User::all());
    	$postCount     = count(Post::all());
    	$categoryCount = count(Category::all());
    	$replyCount    = count(CommentReply::all());
    	$commentCount  = count(Comment::all());
    	$photoCount    = count(Photo::all());

    	return view('admin.index',compact(
    		'userCount',
    		'postCount',
    		'categoryCount',
    		'replyCount',
    		'commentCount',
    		'photoCount'
    	));
    }
}

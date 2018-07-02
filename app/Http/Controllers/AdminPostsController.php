<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use \Session;
use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\{Post,User,Photo,Category};

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        //$posts = Post::all();
        $posts = Post::paginate(2);

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //

        $user = Auth::user();

        $data = $request->all();

        if($file = $request->file('photo_id')){
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(Photo::getPhotoDir(),$fileName);

            $photo = Photo::create(['file'=>$fileName]);

            $data['photo_id'] = $photo->id;
        }

        //$data['user_id'] = $user->id;

        $user->posts()->create($data);

        //return $request->all();
        $posts = Post::all();
        return redirect()->route('admin.posts.index',compact('posts'));
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

        $post = Post::findOrFail($id);
        $categories = $this->_getAllCategories();

        return view('admin.posts.edit',compact('post','categories'));
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

        $data = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move(Photo::getPhotoDir(),$name);

            $photo = Photo::create(['file'=>$name]);

            $data['photo_id'] = $photo->id;
        }
        // dd(Auth::user()->posts());

        $userPosts = Auth::user()->posts();
        if(!empty($userPosts)){
            Session::flash('unauth_update','You are not authorized to update this post');
            return redirect('/admin/posts');
        } else {
            $userPosts->whereId($id)->first()->update($data);
        }
        //Auth::user()->posts()->whereId($id)->first()->update($data);
        return redirect('/admin/posts');
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
        $post = Post::findOrFail($id);

        if($post->photo){
            $photoPath = $post->photo->file;
            unlink(public_path() . $photoPath);
        }

        Session::flash('post_removed','Post ' . $post->title . ' has been removed');

        $post->delete();

        return redirect()->route('admin.posts.index');

    }

    public function post($slug){

        // $post = Post::whereSlug($slug)->firstOrFail();
        $post = Post::where('slug',$slug)->firstOrFail();
        //dd($post);
        //$post = Post::findBySlugOrFail($slug);
        //$post = Post::where(['slug'=>$slug])->firstOrFail();
        $comments = !empty($post) ? $post->comments()->whereIsActive(1)->get() : [];
        $categories = Category::all();
        return view('post',compact('post','comments','categories'));
    }

    private function _addPhoto(Request $request){
        $data = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move(Photo::getPhotoDir(),$name);

            $photo = Photo::create(['file'=>$name]);

            $data['photo_id'] = $photo->id;
        }
    }

    private function _getAllCategories(){
        $categories = Category::pluck('name','id')->all();
        return $categories;
    }

    private function _unlinkPhoto(){
        if($this->photo){
            $photoPath = $this->photo->file;
            unlink(public_path() . $photoPath);
        }
    }
}

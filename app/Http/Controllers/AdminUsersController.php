<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\User;
use App\Photo;
use App\Role;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
	    //
        $users = User::all();
    	return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    //
        //$user = User::create();
        $roles = Role::lists('name','id')->all();
	    return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        //User::create($request->all());

        $data = $request->all();

        if($request->password == null || trim($request->password) == ''){
            $data = $request->except('password');
        } else {
            $data['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);
            $data['photo_id'] = $photo->id;
        }

        $user = User::create($data);

        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();

    	return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $data = $request->all();

        if($request->password == null || trim($request->password) == ''){
            $data = $request->except('password');
        } else {
            $data['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);

            $data['photo_id'] = $photo->id;
        }

        $user->update($data);

        return redirect('/admin/users');
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
        $user      = User::findOrFail($id);
        $name      = $user->name;
        if($user->photo){
            $photoPath = $user->photo->file;
            unlink(public_path()  . $photoPath);
        }

        $response = $user->delete();

        Session::flash('user_removed','You have removed a user: ');

        

        return redirect('/admin/users');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(10);
        $filterKeyword = $request->get('keyword');

        if($filterKeyword){
            $users = \App\User::where('email', 'LIKE', "%$filterKeyword%")->paginate(10);
        }
        
        return view('users.index', ['users' => $users]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $new_user = new \App\User; //ini untuk membuat user baru
        //ini untuk menyimpan atributnya
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->name = $request->get('name');
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make($request->get('password'));

        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');   //simpan file di store dengan kondisi public
            $new_user->avatar = $file; //untuk menyimpan avatar
        }

        $new_user->save();
        return redirect()->route('users.create')->with('status', 'User successfully created.'); //untuk redirect ke halaman user.create jika berhasil disimpan


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::FindorFail($id);
        return view('users.show',['users' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::FindorFail($id); //FindorFail untuk mencari apakah id ditemukan atau tidak
        return view('users.edit',['users' => $user]);  
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
        $user = \App\User::FindorFail($id); //FindorFail untuk mencari apakah id ditemukan atau tidak
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');
        
        if(($user->avatar) && (file_exists(storage_path('app/public'.$user->avatar)))){
            \Storage::delete('public/'.$user->avatar);
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        };

        $user->save();
        return redirect()->route('users.edit',['id' => $id])->with('status','User succesfully updated');
        // return view('users.edit',['users' => $user]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::FindorFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status','user successfully deleted');
    }
}

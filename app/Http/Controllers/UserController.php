<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  array();
        foreach (User::all() as $user) {
            if ($user->hasRole('admin')) {  // fetching all developers who are not admin 
                continue;
            }
            $users[] = $user;
        }
        // return $users;
        return view('developer.index')
                    ->with('developers', $users)
                    ->with('title', 'List of All Developers');
    }

    public function indexForDev()
    {
        $users =  array();
        foreach (User::all() as $user) {
            if ($user->hasRole('admin')) {  // fetching all developers who are not admin 
                continue;
            }
            $users[] = $user;
        }
        // return $users;
        return view('developer.indexForDev')
                    ->with('developers', $users)
                    ->with('title', 'List of All Developers');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('developer.create')
                    ->with('title', 'Add Developer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
        $data = $request->all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->visiblePasskey = $data['password'];
            $user->password = Hash::make($data['password']);

            if($user->save()){
                // Auth::logout();
                return redirect()->route('developer.index')
                            ->with('success','Added successfully');
            }else{
                return redirect()->route('developer.index')
                            ->with('error',"Something went wrong.Please Try again.");
            }
        }
    }

    /**
     * Display the profile Info.
     *
     * @param  none
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
         return view('auth.profile')
                    ->with('title', 'Profile')->with('user', Auth::user());
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
        $developer = User::findOrFail($id);

        return view('developer.edit')
                    ->with('developer', $developer)
                    ->with('title', 'Edit Developer');
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
        $rules =[
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
        $data = $request->all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->visiblePasskey = $data['password'];
            $user->password = Hash::make($data['password']);

            if($user->save()){
                // Auth::logout();
                return redirect()->route('developer.index')
                            ->with('success','Updated successfully');
            }else{
                return redirect()->route('developer.index')
                            ->with('error',"Something went wrong.Please Try again.");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // User::destroy($id);

            return redirect()->route('developer.index')->with('success','Developer Deleted Successfully.');

        }catch(Exception $ex){
            return redirect()->route('developer.index')->with('error','Something went wrong.Try Again.');
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name','slug')->get();
        return view('auth.signup',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|max:20',
            'last_name'  => 'required|max:20',
            'email'      => 'required|email|unique:users|',
            'password'   => 'required',
            'image'      => 'required',
        ]);

        $file = $request->file('image');
        $fileName = date('YmdHi') . $file->getClientOriginalName();
        User::create(
            [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'image'      => $fileName,
            ]);
        $file->move(public_path('uploads'), $fileName);
        Session()->flash('success','User created successfully.');
        return view('backend.dashboard');
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
    }

    public function login_form()
    {
        $categories = Category::select('id','name','slug')->get();
        return view('auth.signin',compact('categories'));
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'      => ['required','email'],
            'password'   => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $categories = Category::select('id','name','slug')->get();
            return view('backend.dashboard',compact('categories'));
        }else{
            Session()->flash('wrong','Wrong something.');
        }
    }
    public function logout(){
       auth()->logout();
       return redirect()->route('user.login');
    }
}

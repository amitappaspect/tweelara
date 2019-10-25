<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Storage;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('auth.profile',compact('user'));
    }

    public function save_profile($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar_file')) {

            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $img = $request->file('avatar_file')->store('avatar');
            $request['avatar'] = $img;
        }
        $user->update($request->all());

        return redirect()->route('profile');
        
    }
}

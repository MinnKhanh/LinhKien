<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        View::share('active', 0);
    }
    public function update()
    {
        return view('user.update');
    }
    public function productFavorite()
    {
        return view('favorite.index');
    }
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();
    //     return Redirect::route('home');
    // }
    public function changePassword()
    {
        return view('auth.passwords.changepassword');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'passwordconfirm' => 'required|same:newpassword',
        ]);

        if (Hash::check($request->input('oldpassword'), auth()->user()->password)) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->input('newpassword'))
            ]);
        }
        return Redirect::route('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register'
        ]);
    }

    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255',
            'userame'=>'required|min:3|max:255|unique:users',
            'email'=>'email:dns|unique:users',
            'password'=>'required|min:5|max:255'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('suskses','Registrasi Berhasil, Silahkan Login!');
    }
}

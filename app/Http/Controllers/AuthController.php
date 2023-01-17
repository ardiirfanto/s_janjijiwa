<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
class AuthController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $req)
    {
        try {
            $req->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $login = Auth::attempt(['username' => $req->username, 'password' => $req->password]);

            if (!$login) {
                Alert::error('Login Gagal');
                return back();
            }

            Alert::success('Login Berhasil');
            return redirect()->route('');
        } catch (Exception $e) {
            Alert::error($e->getMessage());
            return back();
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}

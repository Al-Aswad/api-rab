<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
    }
    public function register(Request $request)
    {
        $dataRegistrasi = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $dataRegistrasi['password'] = Hash::make($request->password);

        $user = User::create($dataRegistrasi);

        if ($user)
            return ResponseFormatter::success($dataRegistrasi, 'Berhasil Menabah Bidang');
    }

    public function login(Request $request)
    {
        $dataLogin = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($dataLogin)) {

            $userAuth = User::where('name', $request['name'])->first();

            $userlogin = ([
                'username' => $userAuth['name'],
                'role' => $userAuth['role'],
            ]);
            return ResponseFormatter::success($userlogin, 'Login Berhasil !');
        }

        return ResponseFormatter::success($dataLogin, 'Login Gagal !');
    }
};

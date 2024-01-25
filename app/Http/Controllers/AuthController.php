<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('app.auth.login');
    }

    public function register()
    {
        return view('app.auth.register');
    }

    public function loginProcess(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request['remember'] === 'on')) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'Email or password is incorrect',
        ])->onlyInput('email');
    }

    public function registerProcess(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => UserRole::USER,
        ]);

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return back();
    }

}

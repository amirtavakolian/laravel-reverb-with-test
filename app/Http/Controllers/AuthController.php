<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $isUserExist = User::query()->where('email', $request->validated('email'))->exists();

        if ($isUserExist) {
            return redirect()->back()->with('user_exist', 'email is currently exist');
        }

        $userValidatedData = $request->validated();
        $userValidatedData['password'] = Hash::make($userValidatedData['password']);

        $newRegisteredUser = User::query()->create($userValidatedData);

        broadcast(new UserRegistered($newRegisteredUser));

        return redirect()->route('login-form')->with('registered_successfully', 'you have registered successfully');
    }

    public function loginView()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $loginResult = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if (!$loginResult) {
            return redirect()->back()->with('login_fail', 'user or password is wrong');
        }

        return redirect()->route('panel-index')->with('successfully_login', 'you have successfully loged in');

    }
}

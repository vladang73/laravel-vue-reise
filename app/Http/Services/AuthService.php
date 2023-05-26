<?php

namespace App\Http\Services;

use App\Events\ForgotPassword;
use App\Events\UserCreated;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $data)
    {
        if (Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            $user = Auth::user();
            $user->generateToken();
            return true;
        }
        return false;
    }

    public function logout()
    {
       return Auth::logout();
    }

    public function register(CreateUserRequest $data)
    {
        $password = str_random(8);
        User::create([
            'email' => $data->email,
            'password' => $password,
            'name' => ''
        ]);

        event(new UserCreated($data->email, $password));
        return true;
    }

    public function deleteByEmail($email)
    {
        $user = User::where('email', '=', $email);
        if($user) {
            $user->delete();
        }
    }

    public function forgotPassword($email)
    {
        $user = User::where('email', '=', $email)->first();
        if(!$user) {
            return false;
        }
        $user->generateRecoveryHash();
        return event(new ForgotPassword(($user)));
    }

    public function changePass($data)
    {
        $data->user->password = $data->password;
        $data->user->save();
        Auth::login($data->user);
    }
}
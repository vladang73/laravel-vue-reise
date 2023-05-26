<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Services\AuthService;
use App\Models\Booking;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        return view('auth/login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request))
        {
            return redirect('/admin');
        }
        $errors = $this->addError('password', __('auth.wrong_input'));
        return redirect()->to('/auth/login')->withErrors($errors);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/auth/login');
    }

    public function showForgot()
    {
        return view('auth/forgot');
    }

    public function forgot(ForgotPasswordRequest $request)
    {
        $this->authService->forgotPassword($request->email);
        return view('auth/code_sent');
    }

    public function recovery(string $hash)
    {
        $this->findUserByHash($hash);
        return view('auth/change_pass')->with(['hash' => $hash]);
    }

    public function changePass(ChangePasswordRequest $request, string $hash)
    {
        $user = $this->findUserByHash($hash);
        $request->user = $user;
        $this->authService->changePass($request);
        return redirect()->to('/auth/login');
    }

    private function findUserByHash($hash)
    {
        $user = User::where('recovery_hash', '=', $hash)->first();
        if(!$user) {
            abort(404);
        }
        return $user;
    }

    public function getToken()
    {
        $user = Auth::user();
        return response()->json([
            'token' => $user->token,
            'name' => $user->first_name . ' ' . $user->last_name,
            'image' => $user->image
        ]);
    }
}
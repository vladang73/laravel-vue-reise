<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        /**
         * @var User $user
         */
        $user = Auth::user();

        if(null === $user) {
            return redirect('auth/login');
        }

        return view('admin', [
            'token' => $user->token,
            'name' => $user->first_name . ' ' . $user->last_name,
        ]);
    }
}

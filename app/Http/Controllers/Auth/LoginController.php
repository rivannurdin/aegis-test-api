<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        $token = null;
        if(!$token = Auth::guard()->attempt($credentials)){
            return $this->falseResponse(__('auth.failed'));
        }

        if (Auth::user()->status === User::STATUS_INACTIVE) {
            return $this->falseResponse(__('auth.inactive'));
        }

        return $this->trueResponse('Login User', [
            'access_token' => $token,
            'token_type'   => 'bearer',
        ]);
    }
}

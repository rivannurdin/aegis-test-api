<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard()->user();

        if (!$user) {
            return $this->trueResponse('Logout');
        }

        Auth::guard()->logout();

        return $this->trueResponse('Logout');
    }
}

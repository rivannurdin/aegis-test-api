<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        return $this->trueResponse('Profile', $data);
    }
}

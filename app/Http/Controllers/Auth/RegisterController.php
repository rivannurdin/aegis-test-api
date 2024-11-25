<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required'],
        ]);

        $model           = new User();
        $model->name     = $request->input('name');
        $model->email    = $request->input('email');
        $model->password = Hash::make($request->input('password'));
        $model->role_id  = User::CASHIER_ROLE;
        $model->save();

        return $this->trueResponse('Register User', [
            'id' => $model->id
        ]);
    }
}

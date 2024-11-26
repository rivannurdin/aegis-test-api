<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = User::where('id', $request->id)
            ->where('role_id', User::CASHIER_ROLE)
            ->where('status', User::STATUS_INACTIVE)
            ->first();

        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        $model->status = User::STATUS_ACTIVE;
        $model->save();

        return $this->trueResponse('Activated Cashier', ['id' => $model->id]);
    }
}

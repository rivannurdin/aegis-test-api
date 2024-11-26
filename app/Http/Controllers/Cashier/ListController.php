<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = User::where('role_id', User::CASHIER_ROLE)
            ->orderby('created_at', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $model */
        $model = $query->cursorPaginate($request->limit);
        $model = $model->through(fn ($item) => [
            'id'          => $item->id,
            'name'        => $item->name,
            'email'       => $item->email,
            'status'      => User::STATUS[$item->status],
            'register_at' => Carbon::parse($item->created_at)->format('d-m-Y'),
        ]);

        return $this->trueResponse('List Cashier', $model);
    }
}

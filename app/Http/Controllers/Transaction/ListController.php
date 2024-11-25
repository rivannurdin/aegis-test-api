<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Transaction::where(function($query) use ($request){
            if ($request->filled('filterDate')) {
                $query->whereDate('date', $request->filterDate);
            }
        })->orderby('date', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $model */
        $model = $query->cursorPaginate($request->limit);
        $model = $model->through(fn ($item) => [
            'id'             => $item->id,
            'date'           => Carbon::parse($item->date)->format('d-m-Y'),
            'customer_name'  => $item->customer_name,
            'customer_phone' => $item->customer_phone,
            'total_payment' => 'Rp '.number_format($item->total_payment, 0, ',', '.'),
            'status' => Transaction::STATUS[$item->status],
        ]);

        return $this->trueResponse('List Transaction', $model);
    }
}

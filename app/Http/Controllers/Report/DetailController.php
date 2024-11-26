<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = Transaction::where('id', $request->id)->first();

        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        $items = [];
        foreach ($model->transactionItems as $item) {
            $items[] = [
                'id'            => $item->id,
                'product_id'    => $item->product->id,
                'product_name'  => $item->product->name,
                'product_price' => $item->product->price,
                'quantity'      => $item->quantity,
                'total_price'   => 'Rp '.number_format($item->total_price, 0, ',', '.'),
            ];
        }

        $data = [
           'id'               => $model->id,
           'date'             => Carbon::parse($model->date)->format('d-m-Y'),
           'customer_name'    => $model->customer_name,
           'customer_phone'   => $model->customer_phone,
           'customer_address' => $model->customer_address,
           'total_payment'    => 'Rp '.number_format($model->total_payment, 0, ',', '.'),
           'status'           => Transaction::STATUS[$model->status],
           'items'            => $items
        ];

        return $this->trueResponse('Detail Transaction', $data);
    }
}

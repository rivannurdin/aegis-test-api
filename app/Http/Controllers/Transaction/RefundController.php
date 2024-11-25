<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = Transaction::where('id', $request->id)->first();

        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        if ($model->status == Transaction::STATUS_REFUND) {
            return $this->falseResponse('Failed, this transaction has either been refunded');
        }

        $model->status = Transaction::STATUS_REFUND;
        
        DB::transaction(function () use ($model) {
            $model->save();
            foreach ($model->transactionItems as $item) {

                if (!$product = Product::where('id', $item->product->id)->first()) {
                    return $this->falseResponse('Product Not Found');
                }
    
                $product->stock = $product->stock + $item->quantity;
                $product->save();
            }
        });

        return $this->trueResponse('Refund Transaction', ['id' => $model->id]);
    }
}

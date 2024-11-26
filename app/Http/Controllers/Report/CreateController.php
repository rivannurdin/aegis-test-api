<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'date'                => ['required', 'date'],
            'customer_name'       => ['required'],
            'customer_phone'      => ['required'],
            'customer_address'    => ['required'],
            'products'            => ['array'],
            'products.*.id'       => ['required', 'integer', 'exists:products,id'],
            'products.*.quantity' => ['integer', 'min:1']
        ]);

        $model  = new Transaction();

        $model->date             = $request->input('date');
        $model->customer_name    = $request->input('customer_name');
        $model->customer_phone   = $request->input('customer_phone');
        $model->customer_address = $request->input('customer_address');
        $model->status           = Transaction::STATUS_PAID;
        $model->total_payment    = 0;

        DB::transaction(function () use ($model, $request) {
            $model->save();

            $totalPayment = 0;
            foreach ($request->products as $value) {
                if (!$product = Product::where('id', $value['id'])->first()) {
                    return $this->falseResponse('Product Not Found');
                }
                
                if ($product->stock < $value['quantity']) {
                    return $this->falseResponse('The Product Stock Not Enough');
                }

                $totalPrice = $product->price * $value['quantity'];
                $totalPayment += $totalPrice;

                $transactionItem = new TransactionItem();
                $transactionItem->transaction_id = $model->id;
                $transactionItem->product_id     = $product->id;
                $transactionItem->quantity       = $value['quantity'];
                $transactionItem->total_price    = $totalPrice;
                
                $transactionItem->save();

                $product->stock = $product->stock - $value['quantity'];
                $product->save();
            }

            $updateModel = Transaction::where('id', $model->id)->first();
            $updateModel->total_payment = $totalPayment;
            $updateModel->save();
        });

        return $this->trueResponse('Create Transaction', [
            'id' => $model->id,
        ]);
    }
}
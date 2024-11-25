<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetailController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = Product::where('id', $request->id)->first();

        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        $data = [
            'id'          => $model->id,
            'code'        => $model->code,
            'name'        => $model->name,
            'description' => $model->description,
            'price'       => $model->price,
            'stock'       => $model->stock,
        ];

        return $this->trueResponse('Detail Product', $data);
    }
}

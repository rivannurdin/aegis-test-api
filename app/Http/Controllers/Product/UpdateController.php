<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'id'          => ['required'],
            'code'        => ['required', Rule::unique('products', 'code')->ignore($request->id)],
            'name'        => ['required'],
            'description' => ['required'],
            'price'       => ['required', 'numeric'],
            'stock'       => ['required', 'numeric'],
        ]);
        
        $model = Product::where('id', $request->id)->first();

        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        $model->code        = $request->input('code');
        $model->name        = $request->input('name');
        $model->description = $request->input('description');
        $model->price       = $request->input('price');
        $model->stock       = $request->input('stock');
        $model->save();

        return $this->trueResponse('Update Product', [
            'id' => $model->id,
        ]);
    }
}

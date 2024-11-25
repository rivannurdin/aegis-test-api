<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code'        => ['required', Rule::unique('products', 'code')],
            'name'        => ['required'],
            'description' => ['required'],
            'price'       => ['required', 'numeric'],
            'stock'       => ['required', 'numeric'],
        ]);

        $model              = new Product();
        $model->code        = $request->input('code');
        $model->name        = $request->input('name');
        $model->description = $request->input('description');
        $model->price       = $request->input('price');
        $model->stock       = $request->input('stock');
        $model->save();

        return $this->trueResponse('Create Product', [
            'id' => $model->id,
        ]);
    }
}

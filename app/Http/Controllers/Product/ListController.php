<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $models = Product::orderby('created_at', 'DESC')->get();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                'id'    => $model->id,
                'code'  => $model->code,
                'name'  => $model->name,
                'stock' => $model->stock,
            ];
        }

        return $this->trueResponse('List Product', $data);
    }
}

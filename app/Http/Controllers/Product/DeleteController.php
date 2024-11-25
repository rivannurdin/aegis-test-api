<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = Product::where('id', $request->id)->first();
        
        if (!$model) {
            return $this->falseResponse('Data Not Found');
        }

        $model->delete();

        return $this->trueResponse('Delete Product');
    }
}

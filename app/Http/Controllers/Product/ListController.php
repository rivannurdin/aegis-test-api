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
        $query = Product::where(function($query) use ($request){
            if ($request->filled('search')) {
                $query->where('name', 'ILIKE', "{$request->search}%");
            }
        })->orderby('id', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $model */
        $model = $query->cursorPaginate($request->limit);
        $model = $model->through(fn ($item) => [
            'id'    => $item->id,
            'code'  => $item->code,
            'name'  => $item->name,
            'stock' => $item->stock,
        ]);

        return $this->trueResponse('List Product', $model);
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->has('filter')) return $this->filter($request);

        $products = Product::orderBy('id')->paginate(env('PAGINATION','10'));
        return response()->json($products,200);
    }

    private function filter(Request $request){
        $category = ProductCategory::where('title',$request->get('filter'))->first();

        $products = (!$category) ?
            null:
            $category->products()->paginate(env('PAGINATION','10'));
        return response()->json($products,200);
    }
}

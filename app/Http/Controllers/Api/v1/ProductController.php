<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id')->paginate(env('PAGINATION','10'));
        return response()->json($products,200);
    }
}

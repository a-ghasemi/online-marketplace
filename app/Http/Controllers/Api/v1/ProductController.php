<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/v1/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get paginated list of products",
     *      description="Returns paginated list of products",
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="filter",
     *          description="Category title | Shows filtered list",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
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

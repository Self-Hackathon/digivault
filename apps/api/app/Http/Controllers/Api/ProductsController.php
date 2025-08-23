<?php

namespace App\Http\Controllers\Api;

use App\Actions\Products\ListProducts;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    use ApiResponse;

    public function __construct(private ListProducts $listProducts)
    {
    }

    public function index(Request $request)
    {
        $listProducts = $this->listProducts->execute($request->input('limit', 10));

        if ($listProducts) {
            return $this->successResponse($listProducts);
        }

        return $this->errorResponse(null, 'No products found');
    }
}

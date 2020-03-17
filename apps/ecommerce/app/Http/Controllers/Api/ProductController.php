<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProductsService;

class ProductController extends BaseApiController
{
    protected $productsService;

    /**
     * Create a new controller instance.
     *
     * @param ProductsService $productsService product service
     *
     * @return void
     */
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productsService
            ->setProductId($id)
            ->getProductWithImageById();
        return $this->sendResponse($product);
    }

    /**
     * Search products by conditions.
     *
     * @param Request $request request
     *
     * @return json
     */
    public function search(Request $request)
    {
        $products = $this->productsService
            ->setRequest($request)
            ->searchProductsByCategoryNameAndKeyword();

        return $this->sendResponse($products);
    }
}

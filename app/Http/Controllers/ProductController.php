<?php

namespace App\Http\Controllers;

use App\Contracts\ProductInterface;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductStoreResource;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    protected $productRepo;

    /**
     * ProductController constructor.
     * @param ProductInterface $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = $this->productRepo->store();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->products()->sync($request->all());
        return new ProductStoreResource(count($user->products));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function basketCount()
    {
        $basket = \auth()->user()->products;
        return response($basket);
    }
}

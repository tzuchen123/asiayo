<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Services\OrderSerive;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $orderSerive;

    public function __construct(OrderSerive $orderSerive)
    {
        $this->orderSerive = $orderSerive;
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $order = $request->validated();
        return $this->orderSerive->validateAndTransformOrder($order);
    }

}

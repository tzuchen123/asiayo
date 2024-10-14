<?php

namespace App\Services;

use App\Contracts\OrderValidatorInterface;
use App\Contracts\OrderTransformerInterface;

class OrderSerive
{
    protected $validator;
    protected $transformer;

    public function __construct(OrderValidatorInterface $validator, OrderTransformerInterface $transformer)
    {
        $this->validator = $validator;
        $this->transformer = $transformer;
    }

    public function validateAndTransformOrder(array $order)
    {
        // Validate the order
        $validatedOrder = $this->validator->validate($order);

        // Check validation status
        if (!$validatedOrder['status']) {
            return response()->json([
                'message' => $validatedOrder['message']
            ], 400);
        }

        // Transform the order
        $transformedOrder = $this->transformer->transform($validatedOrder['data']);

        // Return the transformed order
        return response()->json([
            'message' => 'Order processed successfully',
            'data' => $transformedOrder
        ], 200);
    }
}

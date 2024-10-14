<?php

namespace App\Services;

use App\Contracts\OrderTransformerInterface;

class OrderTransformer implements OrderTransformerInterface
{
    public function transform(array $order): array
    {
        if ($order['currency'] === 'USD') {
            $order['price'] =  $order['price'] * 31;
            $order['currency'] =  'TWD';
        }

        return $order;
    }
}

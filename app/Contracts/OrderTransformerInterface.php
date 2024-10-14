<?php

namespace App\Contracts;

interface OrderTransformerInterface
{
    public function transform(array $orderData): array;
}

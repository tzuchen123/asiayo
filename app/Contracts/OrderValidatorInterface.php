<?php

namespace App\Contracts;

interface OrderValidatorInterface
{
    public function validate(array $order): array;
}

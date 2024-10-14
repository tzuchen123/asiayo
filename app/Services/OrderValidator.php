<?php

namespace App\Services;

use App\Contracts\OrderValidatorInterface;

class OrderValidator implements OrderValidatorInterface
{
    public function validate(array $order): array
    {        
        $status = true;
        $message = 'Validation passed';            
        
        if (!preg_match('/^[a-zA-Z\s]+$/', $order['name'])) {
            $status = false;
            $message = 'Name contains non-English characters';
        }

        $words = explode(' ', $order['name']);
        foreach ($words as $word) {
            if (!preg_match('/^[A-Z]/', $word)) {
                $status = false;
                $message = 'Name is not capitalized';
            }
        }    

        if ($order['price'] > 2000) {
            $status = false;
            $message = 'Price is over 2000';
        }

        if (!in_array($order['currency'], ['TWD', 'USD'])) {
            $status = false;
            $message = 'Currency format is wrong';
        }

        return [
            'status' => $status,
            'message' => $message,
            'data' => $order
        ];
    }

}

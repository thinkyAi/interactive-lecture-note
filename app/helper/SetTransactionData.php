<?php

namespace App\helper;

use App\DataObjects\TransactionData;

class SetTransactionData
{
    public function all(array $data): TransactionData
    {
        return new TransactionData(
            $data['description'],
            (float) $data['amount'],
            new \DateTime($data['date']),
            $data['category']
        );
    }

}
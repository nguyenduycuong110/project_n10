<?php

namespace App\Services\Interfaces;

/**
 * Interface ExpenseServiceInterface
 * @package App\Services\Interfaces
 */
interface ExpenseServiceInterface
{
    public function paginate($request);
}

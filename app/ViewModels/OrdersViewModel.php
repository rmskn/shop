<?php

namespace App\ViewModels;

use App\Dto\OrderDto;

class OrdersViewModel
{
    /**
     * @var OrderDto[]
     */
    public array $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }
}

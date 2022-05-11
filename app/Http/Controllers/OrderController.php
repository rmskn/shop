<?php

namespace App\Http\Controllers;

use App\DataAccess\Repositories\OrderRepository;
use App\ViewModels\OrdersViewModel;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrdersPage()
    {
        $userId = Auth::id();
        $userId = 1;

        $orders = $this->orderRepository->getUserOrders($userId);

        $viewModel = new OrdersViewModel($orders);

        return view('profile.orders', ['ordersViewModel' => $viewModel]);
    }
}

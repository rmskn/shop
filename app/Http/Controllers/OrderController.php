<?php

namespace App\Http\Controllers;

use App\DataAccess\Repositories\OrderRepository;
use App\Service\OrderService;
use App\ViewModels\ActionResultViewModel;
use App\ViewModels\OrdersViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;
    private OrderService $orderService;

    public function __construct(OrderRepository $orderRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function getOrdersPage()
    {
        $userId = Auth::id();

        $orders = $this->orderRepository->getUserOrders($userId);

        $viewModel = new OrdersViewModel($orders);

        return view('profile.orders', ['ordersViewModel' => $viewModel]);
    }

    public function createOrder(Request $request)
    {
        $userId = Auth::id();
        $jsonCart = $request['cart'];
        $cart = $this->orderService->decodeJsonCart($jsonCart);
        $cartPrice = $this->orderService->calculateCartPrice($cart);

        $result = $this->orderRepository->createOrder($cart, $cartPrice, $userId);

        if ($result) {
            $viewModel = new ActionResultViewModel(
                true,
                'createOrder',
                true,
                'Order is accepted!',
                ['clearCart'],
                'Go to check your orders',
                route('orders')
            );
        } else {
            $viewModel = new ActionResultViewModel(
                true,
                'createOrder',
                false,
                'Something went wrong',
                ['clearCart'],
                'Go to catalog',
                route('catalog')
            );
        }

        return view('action-result', ['actionResultViewModel' => $viewModel]);
    }
}

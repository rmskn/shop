<?php

namespace App\DataAccess\Repositories;

use App\Dto\OrderDto;
use App\Dto\OrderProductDto;
use App\Models\Order;
use App\Service\OrderService;
use DateTime;
use Illuminate\Support\Facades\DB;
use PDOException;

class OrderRepository
{
    private OrderProductRepository $orderProductRepository;
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private StatusRepository $statusRepository;

    public function __construct(
        OrderProductRepository $orderProductRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        StatusRepository $statusRepository
    ) {
        $this->orderProductRepository = $orderProductRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->statusRepository = $statusRepository;
    }

    /**
     * @param int $userId
     * @return OrderDto[]
     */
    public function getUserOrders(int $userId): array
    {
        /** @var OrderDto[] $answer */
        $userOrders = [];

        $orders = Order::query()
            ->select('id', 'price', 'status', 'date')
            ->where('user_id', $userId)
            ->orderByDesc('date')
            ->get()
            ->toArray();

        foreach ($orders as $order) {
            $products = $this->orderProductRepository->getByOrderId($order['id']);
            $count = $this->orderProductRepository->getCountOfProducts($order['id']);
            $statusTitle = $this->statusRepository->getStatusTitleByCode($order['status']);

            /** @var OrderProductDto[] $orderProducts */
            $orderProducts = [];
            foreach ($products as $product) {
                $productFromDb = $this->productRepository->getById($product['product_id']);
                $categories = $this->categoryRepository->getCategoriesOfProduct($product['product_id']);
                $orderProducts[] = new OrderProductDto(
                    $product['product_id'],
                    $productFromDb['title'],
                    $productFromDb['description'],
                    $product['price'],
                    $productFromDb['price'],
                    $product['count'],
                    $productFromDb['pictures'],
                    $categories
                );
            }

            $userOrders[] = new OrderDto(
                $order['id'],
                $order['price'],
                $order['status'],
                $statusTitle,
                $order['date'],
                $count,
                $orderProducts
            );
        }

        return $userOrders;
    }

    public function createOrder(array $cart, float $cartPrice, int $userId): bool
    {
        try {
            DB::beginTransaction();

            $order = new Order();
            $order->user_id = $userId;
            $order->status = 0;
            $order->date = new DateTime();
            $order->price = $cartPrice;
            $order->save();

            $orderId = $order->id;

            foreach ($cart as $productId => $product) {
                $this->orderProductRepository->create($orderId, $productId, $product['count'], $product['price']);
            }

            DB::commit();
        } catch (PDOException $exception) {
            DB::rollBack();
            return false;
        }

        return true;
    }

}

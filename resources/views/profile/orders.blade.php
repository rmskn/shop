<?php
/** @var App\ViewModels\OrdersViewModel $ordersViewModel */
?>
<html lang="en">
<head>
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<p class="h1 text-center">Your orders</p>
<table class="table w-50 mt-3 ml-3 mx-auto">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Price</th>
        <th scope="col">Count of items</th>
        <th scope="col">Current status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ordersViewModel->orders as $order)
        <tr>
            <td>
                {{$order->id}}
            </td>
            <td>
                {{$order->date}}
            </td>
            <td>
                {{$order->price}} RUB
            </td>
            <td>
                {{$order->totalCount}} items
            </td>
            <td>
                {{$order->statusTitle}}
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <table class="table table-striped w-50 p-3 mx-auto">
                    @foreach($order->products as $product)
                        <tr>
                            <td>
                                {{$product->id}}
                            </td>
                            <td>
                                {{$product->title}}
                            </td>
                            <td>
                                @foreach($product->categories as $category)
                                    {{$category['title']}}
                                    @if (!$loop->last)
                                        <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$product->count}} items
                            </td>
                            <td>
                                {{$product->priceInOrder}} RUB
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

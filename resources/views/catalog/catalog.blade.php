<?php
/** @var App\ViewModels\CatalogViewModel $catalogViewModel */ ?>
<html lang="en">
<head>
    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
@if ($catalogViewModel->auth === true)
    <form action="/logout" method="post">
        @csrf
        <input type="submit" value="Logout">
    </form>

    <a href="{{route('orders')}}">Orders</a>
@else
    <form action="/login">
        <input type="submit" value="Login"/>
    </form>
@endif
<p class="h1 text-center mb-4">Product list</p>
<table class="table w-75 p-3 mx-auto">
    @foreach($catalogViewModel->products as $product)
        <tr>
            <td>
                {{$product['id']}}
            </td>
            <td>
                @if (count(json_decode($product['pictures']))>0)
                    <img src="{{json_decode($product['pictures'])[0]}}" alt="photo" height="50pt">
                @endif
            </td>
            <td>
                {{$product['title']}}
            </td>
            <td>
                @foreach($product['categories'] as $category)
                    {{$category['title']}}<br>
                @endforeach
            </td>
            <td>
                {{$product['price']}} RUB
            </td>
{{--            <td>--}}
{{--                <a href="">Delete</a>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <a href="">Edit</a>--}}
{{--            </td>--}}
            <td>
                <a href="">Add to cart</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>

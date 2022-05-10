<?php
/** @var App\ViewModels\CatalogViewModel $catalogViewModel */ ?>
<html lang="en">
<body>
@if ($catalogViewModel->auth === true)
    <form action="/logout" method="post">
        @csrf
        <input type="submit" value="Logout">
    </form>

    <form action="/orders">
        @csrf
        <input type="submit" value="Orders">
    </form>
@else
    <form action="/login">
        <input type="submit" value="Login" />
    </form>
@endif
<h1>Product list</h1>
<table>
    @foreach($catalogViewModel->products as $product)
        <tr>
            <td>
                {{$product['id']}}
            </td>
            <td>
                @if (count(json_decode($product['pictures']))>0)
                    <img src="{{json_decode($product['pictures'])[0]}}" alt="here must be photo" width="50pt">
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
            <td>
                <a href="">Delete</a>
            </td>
            <td>
                <a href="">Edit</a>
            </td>
            <td>
                <a href="">Add to cart</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>

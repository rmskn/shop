<?php

/** @var App\ViewModels\CatalogViewModel $catalogViewModel */ ?>
<html lang="en">
<head>
    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
@include('header', ['auth' => $catalogViewModel->auth, 'page' => 'Catalog'])

<p class="h1 text-center mb-4">Product list</p>

<div class="container mx-auto mb-3 text-center">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="category" data-filter="0" checked>
        <label class="form-check-label" for="category">All</label>
    </div>
    @foreach($catalogViewModel->availableCategories as $category)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category" data-filter="{{$category['code']}}">
            <label class="form-check-label" for="category{{$category['code']}}">{{$category['title']}}</label>
        </div>
    @endforeach
</div>

<table class="table w-75 p-3 mx-auto align-middle">
    @foreach($catalogViewModel->products as $product)
        <tr id="product" data-cat="{{json_encode($product['categories'], JSON_THROW_ON_ERROR)}}">
            <td>
                {{$product['id']}}
            </td>
            <td>
                @if (count(json_decode($product['pictures']))>0)
                    <img class="mx-auto d-block" src="{{json_decode($product['pictures'])[0]}}" alt="photo"
                         height="50pt">
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

<script src="{{ asset("js/sort_products.js") }}"></script>

</body>
</html>

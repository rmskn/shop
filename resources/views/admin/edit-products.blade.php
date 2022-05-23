<?php
/** @var App\ViewModels\Admin\EditProductsPageViewModel $editProductsViewModel */ ?>
<html lang="en">
<head>
    <title>Edit products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark p-2">
    <a class="navbar-brand p-0" href="{{route('manager')}}">
        <img src="/images/logo.ico" alt="logo" width="48" height="48">

    </a>
    <div class="navbar-brand">Shop Control Panel</div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('manager.edit-products')}}">Edit Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Edit Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Return to shop</a>
            </li>
        </ul>
    </div>
    <div class="d-flex">
        <form class="mb-0" method="POST" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-light" type="submit">Logout</button>
        </form>
    </div>
</nav>

@if(count($editProductsViewModel->products)===0)
    <p class="h1 text-center align-middle">Products list now is empty</p>
    <btn class="btn btn-primary mx-3" href="{{route('manager.new-product')}}">New product</btn>
@else
    <p class="h1 text-center align-middle">Products list</p>


    <div class="container mx-auto mb-3 text-center">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category" data-filter="0" checked>
            <label class="form-check-label" for="category">All</label>
        </div>
        @foreach($editProductsViewModel->availableCategories as $category)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="category" data-filter="{{$category['code']}}">
                <label class="form-check-label" for="category{{$category['code']}}">{{$category['title']}}</label>
            </div>
        @endforeach
        <a class="btn btn-primary mx-3" href="{{route('manager.new-product')}}">New product</a>
    </div>

    <table class="table w-50 mt-3 mx-auto">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Categories</th>
            <th scope="col">Price</th>
            <th scope="col">Images (count)</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($editProductsViewModel->products as $product)
            <tr id="product" data-cat="{{json_encode($product->categories, JSON_THROW_ON_ERROR)}}">
                <td>
                    {{$product->id}}
                </td>

                <td>
                    {{$product->title}}
                </td>
                <td>
                    {{$product->description}}
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
                    {{$product->price}} RUB
                </td>
                <td>
                    {{count(json_decode($product->images, false, 512, JSON_THROW_ON_ERROR))}} items
                </td>
                <td>
                    <a class="btn btn-warning btn-sm"
                       href="{{route('manager.edit-product', ['productId' => $product->id])}}">Edit</a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm"
                       href="{{route('manager.delete-product', ['productId' => $product->id])}}">Delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif

<script src="{{ asset("js/sort_products.js") }}"></script>
<script src="https://kit.fontawesome.com/7a28fbeb41.js" crossorigin="anonymous"></script>
</body>
</html>

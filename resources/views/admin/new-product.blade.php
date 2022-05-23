<?php

/** @var array $availableCategories */ ?>
<html lang="en">
<head>
    <title>Edit product</title>
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

<p class="h1 text-center align-middle mb-3">New product</p>

<form class="w-75 mx-auto" method="post" action="{{route('manager.create-product')}} " enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">ID</span>
                <input type="text" class="form-control" placeholder="Id" aria-label="Id"
                       aria-describedby="addon-wrapping" value="automatically" id="id"
                       name="id" readonly>
            </div>
        </div>
        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Title</span>
                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title"
                       aria-label="Title" aria-describedby="addon-wrapping"
                       value="" id="title" name="title">
                @error('title')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Price (RUB)</span>
                <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Price"
                       aria-label="Price" aria-describedby="addon-wrapping"
                       value="" id="price" name="price">
                @error('price')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Description</span>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description"
                          aria-label="Description" aria-describedby="addon-wrapping" id="description"
                          name="description"></textarea>
                @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="input-group flex-nowrap border rounded">
                <span class="input-group-text" id="addon-wrapping">Categories</span>
                @foreach($availableCategories as $category)
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="checkbox" value="{{$category['id']}}" id="category"
                               data-cat="{{$category['id']}}" name="categories[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$category['title']}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Add new images</label>
        <input class="form-control @error('newImages*') is-invalid @enderror" type="file" id="formFile"
               name="newImages[]" multiple>
        @error('newImages*')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit" id="submitButton">Save</button>

</form>


<script src="{{ asset("js/editProductPage.js") }}"></script>
</body>
</html>

<?php

/** @var App\ViewModels\CartViewModel $cartViewModel */ ?>
<html lang="en">
<head>
    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
@include('header', ['auth' => $cartViewModel->auth, 'page' => 'Cart'])

<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0" id="cartArea">
                        <div class="col-lg-8">
                            <div class="p-5" id="productsList">

                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5" id="orderParam">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset("js/Cart.js") }}"></script>
<script src="{{ asset("js/cartConfirmOrderPage.js") }}"></script>
<script src="https://kit.fontawesome.com/7a28fbeb41.js" crossorigin="anonymous"></script>
</body>
</html>

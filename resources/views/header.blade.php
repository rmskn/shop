<?php
/** @var bool $auth */

/** @var string $page */

?>
<nav class="navbar navbar-expand navbar-dark bg-dark p-2">
    <a class="navbar-brand p-0" href="/">
        <img src="/images/logo.ico" alt="logo" width="48" height="48">
        {{--        <a class="navbar-brand" href="/">Shop</a>--}}
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('catalog')}}">Catalog</a>
            </li>
            @if ($auth === true)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('orders')}}">Orders</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('cart')}}">
                    Cart
                    <span class="badge bg-primary rounded-pill" id="cartQuantity">0</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="d-flex">
        @if ($auth === true)
            <form class="mb-0" method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-light" type="submit">Logout</button>
            </form>
        @else
            <a class="nav-link" href="{{route('login')}}" type="submit">Login</a>
            <a class="btn btn-light" href="{{route('register')}}" type="submit">Sing in</a>
        @endif
    </div>
</nav>

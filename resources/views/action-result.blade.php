<?php
/** @var App\ViewModels\ActionResultViewModel $actionResultViewModel */ ?>
<html lang="en">
<head>
    <title>Action result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
@include('header', ['auth' => $actionResultViewModel->auth, 'page' => 'Action result'])

<p class="h1 text-center mb-4">{{$actionResultViewModel->mainMessage}}</p>

<a href="{{$actionResultViewModel->linkToContinue}}">
    <p class="h4 text-center mb-4">{{$actionResultViewModel->messageToContinue}}</p>
</a>

<div id="info" hidden>
    <div id="lastAction" value="{{$actionResultViewModel->lastAction}}"></div>
    <div id="status" value="{{$actionResultViewModel->status}}"></div>
    <div id="actionsToDo" value="{{json_encode($actionResultViewModel->actionsToDo, JSON_THROW_ON_ERROR)}}"></div>
</div>

<script src="{{ asset("js/Cart.js") }}"></script>
<script src="{{ asset("js/actionResultPage.js") }}"></script>
<script src="{{ asset("js/update_cart_counter.js") }}"></script>
</body>
</html>

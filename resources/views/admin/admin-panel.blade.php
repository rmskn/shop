<html lang="en">
<head>
    <title>Admin panel</title>
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

<div class="container px-4 py-5" id="icon-grid">
    <h3 class="pb-2 border-bottom">
        <i class="fa-solid fa-screwdriver-wrench"></i>
        Control panel
    </h3>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">

        <div class="col d-flex align-items-start">
            <div class="bi flex-shrink-0 me-3 mt-3">
                <i class="fa-solid fa-pen-to-square fa-lg"></i>
            </div>
            <div>
                <a class="text-decoration-none text-dark" href="{{route('manager.edit-products')}}">
                    <h4 class="fw-bold mb-0">Edit products</h4>
                </a>
                <p>You can moderate products. Add new and update old items.</p>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="bi flex-shrink-0 me-3 mt-3">
                <i class="fa-solid fa-pen-to-square fa-lg"></i>
            </div>
            <div>
                <a class="text-decoration-none text-dark" href="#">
                    <h4 class="fw-bold mb-0">Edit orders</h4>
                </a>
                <p>You can moderate orders. Change and control statuses.</p>
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/7a28fbeb41.js" crossorigin="anonymous"></script>
</body>
</html>

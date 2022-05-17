<?php

namespace App\Http\Controllers;

use App\ViewModels\CartViewModel;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCartPage()
    {
        $isAuth = false;

        if (Auth::user()) {
            $isAuth = true;
        }

        $viewModel = new CartViewModel($isAuth);

        return view('profile.cart', ['cartViewModel' => $viewModel]);
    }
}

<?php

namespace App\ViewModels;

class CartViewModel
{
    public bool $auth;

    /**
     * @param bool $auth
     */
    public function __construct(bool $auth)
    {
        $this->auth = $auth;
    }
}

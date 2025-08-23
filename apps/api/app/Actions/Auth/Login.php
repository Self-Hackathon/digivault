<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class Login
{
    public function execute(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}

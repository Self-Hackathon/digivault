<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class Logout
{
    public function execute(): void
    {
        Auth::logout();
    }
}

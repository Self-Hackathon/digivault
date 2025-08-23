<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\Login as LoginAction;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ApiResponse;

    public function __construct(private LoginAction $login) {}

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (ValidationException $e) {
            return $this->errorResponse(
                data: null,
                error: $e->getMessage(),
            );
        }

        $login = $this->login->execute($credentials);

        if ($login) {
            $request->session()->regenerate();

            return $this->successResponse(
                data: null,
            );
        }

        return $this->failedResponse(
            error: 'Incorrect email or password',
        );
    }
}

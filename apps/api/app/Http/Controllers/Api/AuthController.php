<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\Login as LoginAction;
use App\Actions\Auth\Logout as LogoutAction;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(private LoginAction $login, private LogoutAction $logout)
    {
    }

    /**
     * Handle user login request.
     *
     * Validates user credentials and attempts authentication.
     * On success, regenerates the session ID to prevent fixation
     * and returns a success JSON response. On failure, returns
     * an error JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
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

        return $this->errorResponse(
            error: 'Incorrect email or password',
        );
    }

    /**
     * Handle user logout and invalidate the current session.
     *
     * This method executes the logout action, invalidates the session,
     * regenerates the CSRF token, and returns a success JSON response.
     *
     * @param \Illuminate\Http\Request        $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->logout->execute();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->successResponse(
            data: null,
        );
    }

    /**
     * Retrieve the currently authenticated user's information.
     *
     * Returns the authenticated user instance associated with the
     * current request, wrapped in a success JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $this->successResponse(
            data: $request->user(),
        );
    }
}

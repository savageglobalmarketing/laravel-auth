<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Nwidart\Modules\Routing\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     * @throws ValidationException
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);

        if ($response == 'passwords.token') {
            return response()->json(['message' => 'Invalid token'], 402);
        } elseif ($response == 'passwords.user') {
            return response()->json(['message' => 'Invalid email'], 402);
        } elseif ($response == 'passwords.reset') {
            return response()->json(['message' => 'Reset done'], 200);
        } else {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }

    /**
     * Set the user's password.
     *
     * @param CanResetPassword $user
     * @param string $password
     * @return void
     */
    protected function setUserPassword(CanResetPassword $user, string $password)
    {
        $user->password = $password;
    }
}

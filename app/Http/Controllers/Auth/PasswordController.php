<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Auth/ChangePassword');
    }

    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('home'))->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Profilul actualizat cu succes',
                ],
            ],
        ]);
    }

    public function forgotPassword(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $message = Password::sendResetLink(
            $request->only('email')
        );

        if ($message == Password::RESET_LINK_SENT) {
            return back()->with([
                'notifications' => [ 
                    [
                        'type' => 'success',
                        'message' => __($message),
                    ]
                ]
            ]);
        }

        throw ValidationException::withMessages([
            'email' => [trans($message)],
        ]);
    }
}

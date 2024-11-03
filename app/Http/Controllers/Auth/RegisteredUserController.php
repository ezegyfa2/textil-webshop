<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {

        $user = User::create($request->all());

        Auth::login($user);

        return redirect(route('home', absolute: false))->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'V-ați registrat cu succes',
                ],
            ],
        ]);
    }
}

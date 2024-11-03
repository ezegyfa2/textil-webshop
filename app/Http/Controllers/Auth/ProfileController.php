<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Auth/Profile', [
            'user' => UserResource::make(Auth::user())->toArray(request()),
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        Auth::user()->update($request->all());

        return redirect(route('home'))->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Profilul actualizat cu succes',
                ],
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\UserFetchRequest;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Resources\Admin\User\UserFetchResource;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function fetch(UserFetchRequest $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            UserFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/User/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Admin/User/Create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = new User();
        $this->save($user, $request);

        return redirect()->route('admin.user.index')->with([
            'notifications' => [ 
                [
                    'type' => 'success',
                    'message' => 'User successfully created',
                ]
            ]
        ]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => UserResource::make($user)->toArray(request()),
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->save($user, $request);

        return redirect()->route('admin.user.index')->with([
            'notifications' => [ 
                [
                    'type' => 'success',
                    'message' => 'User successfully updated',
                ]
            ]
        ]);
    }

    public function destroy(Request $request, User $user): JsonResponse|RedirectResponse
    {
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => trans('Successfully deleted'),
            ]);
        }

        return redirect()->route('admin.User.index')->with([
            'notifications' => [ 
                [
                    'type' => 'success',
                    'message' => 'User successfully deleted',
                ],
            ],
        ]);
    }

    public function save(User $user, UserRequest $request): User
    {
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();

        return $user;
    }

    protected function getFetchQuery(UserFetchRequest $request): Builder
    {
        $search = $request->input('search', '');

        $query = User::query()
            ->latest();

        if ($search) {
            $query = $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        }

        return $query;
    }
}

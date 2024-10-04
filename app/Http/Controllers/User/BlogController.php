<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Http\Requests\User\BlogFetchRequest;
use App\Http\Resources\User\Blog\BlogResource;
use App\Http\Resources\User\Blog\BlogShortResource;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    public function fetch(BlogFetchRequest $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            BlogShortResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('User/Blog/Index');
    }

    public function show(Blog $blog): Response
    {
        return Inertia::render('User/Blog/Show', [
            'blog' => (new BlogResource($blog))->toArray(request()),
        ]);
    }

    public function getFetchQuery(BlogFetchRequest $request): Builder
    {
        $query = Blog::with('image');
        
        if ($request->search) {
            $query->where('title', 'LIKE', "%$request->search%")
                ->orWhere('content', 'LIKE', "%$request->search%");
        }

        return $query;
    }
}

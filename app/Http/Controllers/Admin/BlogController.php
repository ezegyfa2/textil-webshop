<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogImage;
use App\Http\Resources\Admin\Blog\BlogFetchResource;
use App\Http\Resources\Admin\Blog\BlogResource;
use App\Http\Requests\Admin\Blog\BlogFetchRequest;
use App\Http\Requests\Admin\Blog\BlogRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function fetch(Request $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            BlogFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/Blog/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Blog/Create');
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $this->save($request, new Blog);

        return redirect()->route('admin.blog.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost creată cu succes',
                ],
            ],
        ]);
    }

    public function edit(Blog $blog): Response
    {
        $blog->load('image');

        return Inertia::render('Admin/Blog/Edit', [
            'blog' => new BlogResource($blog),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $this->save($request, $blog);

        return redirect()->route('admin.blog.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost modificat cu succes',
                ],
            ],
        ]);
    }

    protected function save(BlogRequest $request, Blog $blog): void
    {
        $blog->fill($request->except('image'));
        $this->updateImage($blog, $request->get('image'));
        $blog->save();
    }

    public function delete(Blog $blog): JsonResponse
    {
        $blog->delete();

        return response()->json('Produsul a fost eliminată cu succes');
    }

    public function uploadImage(ImageUploadRequest $request): JsonResponse
    {
        $path = $request->file('image')->store('public/uploads');

        return response()->json(Storage::url($path));
    }

    public function deleteImage(BlogImage $blogImage): JsonResponse
    {
        $blogImage->delete();

        return response()->json('A kép sikeresen el lett távolítva');
    }

    protected function getFetchQuery(Request $request): Builder
    {
        $search = $request->input('search', '');

        $query = Blog::latest();

        if ($search) {
            $query = $query->where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%");
        }

        return $query;
    }
}

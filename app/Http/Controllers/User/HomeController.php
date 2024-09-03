<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Http\Resources\User\Blog\BlogShortResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $blogs = Blog::with('image')
            ->whereIn('id', [1, 2, 3])
            ->select([
                'id',
                'title',
                'short_content',
                'image_id',
                'created_at',
            ])
            ->get();
        
        return Inertia::render('User/Home', [
            'main_blog1' => (new BlogShortResource($blogs[0]))->toArray($request),
            'main_blog2' => (new BlogShortResource($blogs[1]))->toArray($request),
            'main_blog3' => (new BlogShortResource($blogs[2]))->toArray($request),
            'blog1' => (new BlogShortResource($blogs[0]))->toArray($request),
            'blog2' => (new BlogShortResource($blogs[1]))->toArray($request),
            'blog3' => (new BlogShortResource($blogs[2]))->toArray($request),
        ]);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\Product\Brand;
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
            ->get();
        
        // TODO: Change to category
        $categories = Brand::with('image')->get();
        
        return Inertia::render('User/Home', [
            'categories' => $categories->map(function ($category) {
                return [
                    'name' => $category->name,
                    'image_src' => $category->image->getSrc(400),
                    'href' => route('product.index') . '?brand=' . $category->id,
                ];
            }),
            'main_blog1' => (new BlogShortResource($blogs[0]))->toArray($request),
            'main_blog2' => (new BlogShortResource($blogs[1]))->toArray($request),
            'main_blog3' => (new BlogShortResource($blogs[2]))->toArray($request),
            'blog1' => (new BlogShortResource($blogs[0]))->toArray($request),
            'blog2' => (new BlogShortResource($blogs[1]))->toArray($request),
            'blog3' => (new BlogShortResource($blogs[2]))->toArray($request),
        ]);
    }

    public function thankYou(): Response
    {
        return Inertia::render('User/ThankYou');
    }

    public function termsAndConditions(): Response
    {
        return Inertia::render('User/TermsAndConditions');
    }

    public function privacyPolicy(): Response
    {
        return Inertia::render('User/PrivacyPolicy');
    }
}

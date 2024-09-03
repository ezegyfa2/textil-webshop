<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function show(Blog $blog): Response
    {
        return Inertia::render('User/Blog/Show');
    }
}

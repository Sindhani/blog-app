<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResourceCollection;
use App\Models\Blog;
use App\Services\BlogManagementService;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function __construct(private readonly BlogManagementService $blogManagementService)
    {
    }

    public function index(): BlogResourceCollection
    {
        $blogs = $this->blogManagementService->getPaginatedBlogs();
        return new BlogResourceCollection($blogs);
    }


    public function show(Blog $blog): JsonResponse
    {
        $blog->loadMissing('comments', 'author');
        $blog->loadCount('comments');

        return response()->json($blog);
    }


}

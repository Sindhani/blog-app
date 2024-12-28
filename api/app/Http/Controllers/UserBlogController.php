<?php

namespace App\Http\Controllers;

use App\Dto\BlogDto;
use App\Http\Requests\BlogFormRequest;
use App\Http\Resources\BlogResourceCollection;
use App\Models\Blog;
use App\Services\BlogManagementService;
use Illuminate\Http\JsonResponse;

class UserBlogController extends Controller
{
    public function __construct(private readonly BlogManagementService $blogManagementService)
    {
    }

    public function index(): BlogResourceCollection
    {
        return new BlogResourceCollection($this->blogManagementService->getPaginatedBlogs(auth()->id()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogFormRequest $request): JsonResponse
    {
        $dto = BlogDto::fromRequest($request);
        $model = $this->blogManagementService->create($dto);
        return response()->json(['message' => 'Blog created', 'data' => $model]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(BlogFormRequest $request, Blog $blog): JsonResponse
    {
        $dto = BlogDto::fromRequest($request);
        $data = $this->blogManagementService->update(
            blog: $blog,
            blogDto: $dto
        );
        return response()->json(['message' => 'Blog updated successfully', 'data' => $data]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $this->blogManagementService->delete($blog);
        return response()->json(['message' => 'Blog deleted']);
    }
}

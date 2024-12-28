<?php

namespace App\Http\Controllers;

use App\Dto\CommentDto;
use App\Http\Requests\CommentFormRequest;
use App\Models\Blog;
use App\Services\BlogManagementService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(
        private readonly BlogManagementService $blogManagementService
    )
    {
    }

    public function store(CommentFormRequest $request, Blog $blog): JsonResponse
    {
        $dto = CommentDto::fromRequest($request);
        $response = $this->blogManagementService->addComment($blog, $dto);
        return response()->json(['message' => 'Comment added successfully', 'data' => $response]);
    }
}

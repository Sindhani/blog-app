<?php

namespace App\Services;

use App\Dto\BlogDto;
use App\Dto\CommentDto;
use App\Enum\BlogStatus;
use App\Models\Blog;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BlogManagementService
{

    public function __construct()
    {
        //
    }

    public function getAllBlogs(int $authorId = null): Collection
    {
        return Blog::query()
            ->when($authorId, fn($query) => $query->where('author_id', $authorId))
            ->get();
    }

    public function getPaginatedBlogs(int $authorId = null): LengthAwarePaginator
    {

        $cacheKey = 'blog_list';

        // Check if the data is cached
        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($authorId) {
            return Blog::query()
                ->with(['author', 'comments'])
                ->withCount(['comments'])
                ->latest()
                ->when($authorId, fn($query) => $query->where('author_id', $authorId))
                ->paginate(10);
        });

    }

    public function update(Blog $blog, BlogDto $blogDto): Blog
    {
        $blog->update($blogDto->toArray());
        Cache::forget('blog_list');
        return $blog;
    }

    public function delete(Blog $blog): ?bool
    {
        $deleted = $blog->delete();
        Cache::forget('blog_list');
        return $deleted;
    }

    public function addComment(Blog $blog, CommentDto $dto): Comment
    {
        $model = $blog->comments()->create($dto->toArray());
        return $model;
    }

    public function create(BlogDto $dto): Blog
    {
        $data = $dto->toArray();
        if ($dto->isScheduled) {
            $data['status'] = BlogStatus::SCHEDULED;
        }
        if ($dto->image instanceof UploadedFile) {
            $name = Storage::url($dto->image->store('blogs', 'public'));
            $data['image'] = $name;
        }
        $blog = Blog::query()->create($data);

        Cache::forget('blog_list');

        return $blog;
    }

    public function getScheduledBlogs(): Collection
    {
        return Blog::query()
            ->where('is_scheduled', true)
            ->where('status', BlogStatus::SCHEDULED)
            ->whereNotNull('publish_date')
            ->whereDate('publish_date', Carbon::today()->format('Y-m-d'))
            ->get();
    }

}

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
        $cacheKey = 'blog_list_page_' . (request('page') ?? 1);
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
        $this->forgetCache();
        return $blog;
    }

    public function forgetCache(): void
    {
        $cacheKey = 'blog_data';
        $perPage = 10;

        $totalBlogs = Blog::query()->count();

        $totalPages = ceil($totalBlogs / $perPage);

        for ($page = 1; $page <= $totalPages; $page++) {
            Cache::forget("{$cacheKey}_page_{$page}");
        }

    }

    public function delete(Blog $blog): ?bool
    {
        $deleted = $blog->delete();
        $this->forgetCache();
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

        $this->forgetCache();

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

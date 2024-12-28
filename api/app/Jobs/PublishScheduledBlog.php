<?php

namespace App\Jobs;

use App\Enum\BlogStatus;
use App\Notifications\BlogPublishedNotification;
use App\Services\BlogManagementService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PublishScheduledBlog implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(BlogManagementService $blogManagementService): void
    {
        $blogs = $blogManagementService->getScheduledBlogs();
        foreach ($blogs as $blog) {
            $blog->update([
                'status' => BlogStatus::PUBLISHED,
            ]);

            // Notify the author
            $blog->author->notify(new BlogPublishedNotification($blog));
        }
    }
}

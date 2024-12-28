<?php

namespace App\Jobs;

use App\Enum\BlogStatus;
use App\Notifications\BlogPublishedNotification;
use App\Services\BlogManagementService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;

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

            $publishTime = Carbon::parse($blog->publish_time);
            $currentTime = Carbon::now();

            if ($publishTime->isSameMinute($currentTime)) {
                $blog->update([
                    'status' => BlogStatus::PUBLISHED,
                ]);
                
                $blog->author->notify(new BlogPublishedNotification($blog));
            }
        }
    }
}

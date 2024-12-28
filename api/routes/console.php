<?php

use App\Jobs\PublishScheduledBlog;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new PublishScheduledBlog)->everyMinute();

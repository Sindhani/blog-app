<?php

namespace App\Http\Controllers;

use App\Services\BlogManagementService;

class TestController extends Controller
{
    public function __invoke(BlogManagementService $blogManagementService)
    {

    }
}

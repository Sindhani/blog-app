<?php

namespace App\Http\Controllers;

use App\Services\BlogManagementService;

class TestController extends Controller
{
    public function __invoke(BlogManagementService $blogManagementService)
    {
        $client = app('Elasticsearch');
        $response = $client->indices()->get(['index' => 'blog']);
        return $response;

    }
}

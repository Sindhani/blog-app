<?php

namespace App\Http\Controllers;

use App\Services\BlogManagementService;
use stdClass;

class TestController extends Controller
{
    public function __invoke(BlogManagementService $blogManagementService)
    {
        $client = app('Elasticsearch');
        $response = $client->indices()->getAlias(['index' => '*']);

        return dd($response);
        $response = $client->search([
            'index' => 'blogs',//config('services.elasticsearch.index'),
            'body' => [
                'query' => [
                    'match_all' => new stdClass(),
                ],
                'size' => 5, // Limit results for testing
            ]
        ]);
        dd($response);
    }
}

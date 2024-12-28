<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private readonly Client $client;

    public function __construct()
    {
        $this->client = app('Elasticsearch');
    }

    public function __invoke(Request $request): JsonResponse
    {
        $searchQuery = $request->input('query');
        $params = [
            'index' => config('services.elasticsearch.index'),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $searchQuery,
                        'fields' => ['title', 'content', 'keywords', 'seo_metadata', 'excerpt'],
                    ],
                ],
            ],
        ];
        $result = $this->client->search($params);
        return response()->json($result['hits']['hits']);
    }
}

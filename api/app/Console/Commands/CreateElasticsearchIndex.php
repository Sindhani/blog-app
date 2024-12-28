<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class CreateElasticsearchIndex extends Command
{
    protected $signature = 'elastic:create-index';
    protected $description = 'Create an Elasticsearch index';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $client = app('Elasticsearch');
        $params = [
            'index' => config('services.elasticsearch.index'),
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1,
                ],
                'mappings' => [
                    'properties' => [
                        'title' => ['type' => 'text'],
                        'content' => ['type' => 'text'],
                        'keywords' => ['type' => 'text'],
                        'excerpt' => ['type' => 'text'],
                    ],
                ],
            ],
        ];

        try {
            $response = $client->indices()->create($params);
            $this->info('Index created: ' . json_encode($response, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            $this->error('Elasticsearch error: ' . $e->getMessage());
        }


    }
}

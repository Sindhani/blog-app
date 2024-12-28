<?php

namespace App\Services;

use Elasticsearch;

class ElasticsearchService
{


    public function search(string $index, array $query): array
    {

        return Elasticsearch\Client::$this->client->search([
            'index' => $index,
            'body' => $query,
        ]);
    }

    public function index(string $index, string $id, array $data): array
    {
        return $this->client->index([
            'index' => $index,
            'id' => $id,
            'body' => $data,
        ]);
    }

    public function delete(string $index, string $id): array
    {
        return $this->client->delete([
            'index' => $index,
            'id' => $id,
        ]);
    }
}

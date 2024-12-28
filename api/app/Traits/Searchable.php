<?php

namespace App\Traits;

use Elasticsearch\Client;

trait Searchable
{
    public static function bootSearchable(): void
    {
        static::created(function ($model) {
            $model->indexToElasticsearch();
        });

        static::updated(function ($model) {
            $model->indexToElasticsearch();
        });

        static::deleted(function ($model) {
            $model->deleteFromElasticsearch();
        });
    }

    public function indexToElasticsearch(): void
    {
        $this->elasticsearchClient()->index([
            'index' => config('services.elasticsearch.index'),
            'id' => $this->id,
            'body' => $this->toArray(),
        ]);
    }

    public function elasticsearchClient(): Client
    {
        return app('Elasticsearch');
    }

    public function deleteFromElasticsearch(): void
    {
        $this->elasticsearchClient()->delete([
            'index' => config('services.elasticsearch.index'),
            'id' => $this->id,
        ]);
    }
}

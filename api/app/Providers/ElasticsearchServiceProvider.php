<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $host = config('elasticsearch.host').':'.config('elasticsearch.port');
        $host = 'elasticsearch';
        // Use 'elasticsearch' if running via Sail.
        $this->app->singleton('Elasticsearch', function () use ($host) {
            return ClientBuilder::create()
                ->setHosts([$host])
                ->build();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batchSize = 50;

        for ($i = 0; $i < 100; $i += $batchSize) {
            $records = Blog::factory()
                ->count($batchSize)
                ->make()
                ->transform(function ($item) {
                    $item->slug = Str::slug($item->title);
                    return $item;
                })
                ->makeHidden(['image_url']);

            foreach ($records as $record) {
                $record->save();
            }
        }
    }
}

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
        $batchSize = 5000;

        for ($i = 0; $i < 200000; $i += $batchSize) {
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

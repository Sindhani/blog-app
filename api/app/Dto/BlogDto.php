<?php

namespace App\Dto;

use App\Http\Requests\BlogFormRequest;
use Illuminate\Http\UploadedFile;


class BlogDto
{
    public function __construct(
        public string       $title,
        public string       $excerpt,
        public string       $content,
        public array        $keywords,
        public array        $seoMetadata,
        public UploadedFile $image,
        public bool         $isScheduled = false,
        public ?string      $publishDate = null,
        public ?string      $publishTime = null,
    )
    {
    }

    public static function fromRequest(BlogFormRequest $request): BlogDto
    {
        return new self(
            title: $request->get('title'),
            excerpt: $request->get('excerpt'),
            content: $request->get('content'),
            keywords: $request->get('keywords'),
            seoMetadata: $request->get('seo_metadata'),
            image: $request->file('image'),
            isScheduled: $request->get('is_scheduled'),
            publishDate: $request->get('publish_date'),
            publishTime: $request->get('publish_time'),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'keywords' => $this->keywords,
            'seo_metadata' => $this->seoMetadata,
            'image' => $this->image,
            'publish_date' => $this->publishDate,
            'author_id' => auth()->id(),
            'is_scheduled' => $this->isScheduled,
            'publish_time' => $this->publishTime,
        ];
    }
}

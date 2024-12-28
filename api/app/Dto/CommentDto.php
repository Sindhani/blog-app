<?php

namespace App\Dto;

use App\Http\Requests\CommentFormRequest;


class CommentDto
{
    public function __construct(
        public string $content,
        public int    $userId,

    )
    {
    }

    public static function fromRequest(CommentFormRequest $request): CommentDto
    {
        return new self(
            content: $request->get('content'),
            userId: auth()->id(),
        );
    }

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'user_id' => $this->userId,
        ];
    }
}

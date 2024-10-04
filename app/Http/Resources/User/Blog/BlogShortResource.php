<?php

namespace App\Http\Resources\User\Blog;

use App\Helpers\CommonHelpers;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => CommonHelpers::getFirstSentence($this->short_content),
            'image_src' => $this->image->getSrc(400),
            'href' => route('blog.show', [
                'blog' => $this->id
            ]),
            'created_at' => $this->created_at->format('Y.M.d'),
        ];
    }
}

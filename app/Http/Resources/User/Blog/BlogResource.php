<?php

namespace App\Http\Resources\User\Blog;

use App\Helpers\CommonHelpers;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'image_src' => $this->image->getSrc(1200),
            'created_at' => $this->created_at->format('Y.M.d'),
        ];
    }
}

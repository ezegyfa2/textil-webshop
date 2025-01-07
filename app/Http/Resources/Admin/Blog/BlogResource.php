<?php

namespace App\Http\Resources\Admin\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->image) {
            $image = [
                'id' => $this->image->id,
                'url' => $this->image->getUrl(770),
            ];
        } else {
            $image = null;
        }
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_content' => $this->short_content,
            'content' => $this->content,
            'image' => $image,
        ];
    }
}

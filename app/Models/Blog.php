<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'short_content',
        'content',
        'image_id',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleted(function($blog) {
            $blog->image->delete();
        });
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(BlogImage::class, 'image_id');
    }
}

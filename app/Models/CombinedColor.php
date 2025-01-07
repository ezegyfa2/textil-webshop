<?php

namespace App\Models;

use App\Helpers\CommonHelpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CombinedColor extends Model
{
    protected $fillable = ['name'];

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'combined_color_colors');
    }

    public function getName(): string
    {
        return CommonHelpers::concatenateStrings($this->colors->pluck(['name']), '/');
    }
}

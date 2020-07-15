<?php

namespace App\Models\Backend;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    // protected $appends = ['thumbnail'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('image')
        ->singleFile()
        ->useFallbackUrl(config('app.placeholder').'800.png')
        ->useFallbackPath(config('app.placeholder').'800.png');
    }

     /**
     * Scope a query to only include active pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getShortBodyAttribute()
    {
        return Str::limit(\strip_tags($this->body), 55, '...');
    }
}

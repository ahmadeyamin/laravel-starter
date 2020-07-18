<?php

namespace App\Models\Backend;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Backend\Page
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $short_body
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

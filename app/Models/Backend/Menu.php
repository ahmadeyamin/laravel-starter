<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Backend\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Backend\MenuItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}

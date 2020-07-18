<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Backend\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int|null $parent_id
 * @property string $title
 * @property string $url
 * @property int $order
 * @property string $terget
 * @property string|null $icon
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Backend\MenuItem[] $childs
 * @property-read int|null $childs_count
 * @property-read \App\Models\Backend\Menu $menu
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereTerget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\MenuItem whereUrl($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model
{
    protected $guarded = ['id'];

    // protected $with = ['childs'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function childs()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id')
        ;
    }
}

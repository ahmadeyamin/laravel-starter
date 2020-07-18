<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Module
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Module extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public static function getAllModules()
    {
        return Cache::rememberForever('modules.all', function() {
            return self::with('permissions')->get();
        });
    }


     /**
     * flushCache
     *
     * @return void
     */
    public static function flushCache()
    {
        Cache::forget('modules.all');
    }
}

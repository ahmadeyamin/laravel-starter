<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property int $module_id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Module $module
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
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
     * AllPermissions
     *
     * @return mixed
     */
    public static function getAllPermissions()
    {
        return Cache::rememberForever('permissions.all', function() {
            return self::all();
        });
    }

    /**
     * flushCache
     *
     * @return void
     */
    public static function flushCache()
    {
        Cache::forget('permissions.all');
    }


    /**
     * module
     *
     * @return void
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function hasRole($roleId)
    {
        // return true;
        return $this->roles->where('id',$roleId)->first() ? true : false;
    }

    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}

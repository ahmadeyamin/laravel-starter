<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $role_id
 * @property int $status
 * @property bool $is_blocked
 * @property string $username
 * @property string|null $name
 * @property string|null $location
 * @property string|null $website
 * @property string|null $bio
 * @property string $email
 * @property string|null $provider
 * @property string|null $provider_token
 * @property string|null $password
 * @property string|null $last_login_ip
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $last_seen_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read void $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProviderToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWebsite($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','provider','provider_token','media'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_seen_at' => 'datetime',
        'is_blocked' => 'boolean',
    ];

    protected $appends = ['avatar'];

    /**
     * registerMediaCollections
     *
     * @return void
     */
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder'))
            ->useFallbackPath(config('app.placeholder'))
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(160)
                    ->height(160);
            });
    }

    /**
     * getAllUsers
     *
     * @return void
     */
    public static function getAllUsers()
    {
        return Cache::rememberForever('users.all', function() {
            return self::with('role')->latest('id')->get();
        });
    }

    /**
     * flush Cache
     *
     * @return void
     */
    public static function flushCache()
    {
        Cache::forget('users.all');
    }

    /**
     * getAvatarAttribute
     *
     * @param  mixed $var
     * @return void
     */
    public function getAvatarAttribute( $var )
    {
        return $this->getFirstMediaUrl('avatar', 'thumb');
    }

    /**
     * role
     *
     * @return void
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }



    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    // public function scopeHasPermission($query,$slug)
    // {
    //     return $this->role->whereFirst('slug', $slug);
    // }
}

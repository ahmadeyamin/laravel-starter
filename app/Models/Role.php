<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * user
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}

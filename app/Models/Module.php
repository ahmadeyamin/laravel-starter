<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

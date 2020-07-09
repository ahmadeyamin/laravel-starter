<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}

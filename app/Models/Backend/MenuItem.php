<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

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

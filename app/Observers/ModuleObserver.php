<?php

namespace App\Observers;

use App\Models\Module;
use App\Models\Permission;

class ModuleObserver
{
    /**
     * Handle the module "created" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function created(Module $module)
    {

        Permission::flushCache();
        return Module::flushCache();
    }

    /**
     * Handle the module "updated" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function updated(Module $module)
    {
        Permission::flushCache();
        return Module::flushCache();
    }

    /**
     * Handle the module "deleted" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function deleted(Module $module)
    {

        Permission::flushCache();
        return Module::flushCache();
    }

    /**
     * Handle the module "restored" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function restored(Module $module)
    {
        //
    }

    /**
     * Handle the module "force deleted" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function forceDeleted(Module $module)
    {
        //
    }
}

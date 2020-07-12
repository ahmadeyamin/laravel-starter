<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
{
    /**
     * Handle the setting "created" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        Setting::flushCache();
    }

    /**
     * Handle the setting "updated" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        Setting::flushCache();
    }

    /**
     * Handle the setting "deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        Setting::flushCache();
    }

    public function forceDeleted(Setting $setting)
    {
        Setting::flushCache();
    }
}

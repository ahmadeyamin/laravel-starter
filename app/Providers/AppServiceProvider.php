<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade::withoutDoubleEncoding();


        if(env('REDIRECT_HTTPS'))
        {
            \URL::forceScheme('https');
        }

        Blade::directive('datetime', function ($date) {
            return "<?php echo ($date)->format('m/d/Y h:iA'); ?>";
        });

        Paginator::useBootstrap();

        Module::observe(\App\Observers\ModuleObserver::class);
        Permission::observe(\App\Observers\PermissionObserver::class);
        Role::observe(\App\Observers\RoleObserver::class);
        Setting::observe(\App\Observers\SettingObserver::class);
    }
}

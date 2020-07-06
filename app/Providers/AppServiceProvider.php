<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y h:iA'); ?>";
        });

        Module::observe(\App\Observers\ModuleObserver::class);
        Permission::observe(\App\Observers\PermissionObserver::class);
        Role::observe(\App\Observers\RoleObserver::class);
    }
}

<?php

namespace App\Providers;

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
    }
}

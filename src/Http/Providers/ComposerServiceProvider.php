<?php

namespace A4fteam\Admpanel\Src\Http\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use A4fteam\Admpanel\Src\Http\ViewComposers\TopNavComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer('admpanel::layouts.templates.client.partials.navigation', TopNavComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace A4fteam\Admpanel;

use Illuminate\Support\ServiceProvider;
use View;
use A4fteam\Admpanel\Http\ViewComposers\TopNavComposer;

class AdmPanelProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__.'/routes/web.php';
       
        
        $this->loadViewsFrom(__DIR__.'/../views/', 'admpanel');
        $this->loadTranslationsFrom(__DIR__.'/../lang/', 'admpanel');
        
        $this->publishes([__DIR__ . '/../lang/' => resource_path() . "/lang/"], 'lang');
        $this->publishes([__DIR__ . '/../Helpers/' => app_path() . "/"], 'app');
        $this->publishes([__DIR__ . '/../config/' => config_path() . "/"], 'config');
        $this->publishes([__DIR__ . '/../public/' => public_path() . "/vendor/admpanel/"], 'assets');
        $this->publishes([__DIR__ . '/../database/' => base_path("database")], 'database');
        
        include app_path('helpers.php');
        
        View()->composer('admpanel::layouts.templates.client.partials.navigation', TopNavComposer::class);
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

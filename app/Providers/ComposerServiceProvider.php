<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\MenuComposer;
use App\Models\Category;
use Cart;
use View;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

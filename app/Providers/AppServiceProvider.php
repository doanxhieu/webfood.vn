<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Bill;
use App\Models\Category;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // ADMIN
        view()->composer('admin.layout.menuleft',function($view){
            $count_bill = Bill::where('status','=','0')->count();
            $view->with(['count_bill'=>$count_bill]);
        });
        // FRONTEND
        view()->composer('frontend.layout.header',function($view){
            $category=Category::with('translation')->where('parent_id','>',0)->get();
            $count_cart= Cart::count();
            $total = Cart::subtotal();
            $view->with(['category'=>$category,'count_cart'=>$count_cart,'total'=>$total]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

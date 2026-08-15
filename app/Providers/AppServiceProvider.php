<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'admin.layout.app'], function ($view) {
           $view->with('navbarCategories', Category::where('is_active', true)
                ->where('show_in_navbar', true)
                ->orderBy('sort_order')
                ->get());

           $view->with('products', Product::where('is_active', true)
                ->get());
        });

       View::composer('*', function ($view) {
          static $siteConfigs = null;

          if ($siteConfigs === null) {
             $siteConfigs = Setting::first();
          }

          $view->with('site', $siteConfigs);
       });
    }
}

<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        View::share('categories_sidebar', Category::withCount('articles')->get());
        View::share('tags_nav', Tag::withCount('articles')->get());
        Paginator::useBootstrapFive();
    }
}

<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
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
        View::composer(['layouts.header'], function ($view) {
            $view->with('categories', Category::select('id', 'title', 'slug')->orderBy('title')->get())
                ->with('searchAuthorKeywords', Author::pluck('name'))
                ->with('searchBookKeywords', Book::pluck('title'));
        });

        View::composer(['components.extensive-search'], function ($view) {
            $view->with('categories', Category::select('id', 'title', 'slug')->orderBy('title')->get());
        });

        View::composer(['dashboard.layouts.app'], function ($view) {
            $view->with('route', Route::currentRouteName());
        });
    }
}

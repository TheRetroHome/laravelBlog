<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
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
        view()->composer('layouts.sidebar', function($view){
        if(Cache::has('all_categories')){
            $all_categories = Cache::get('cats');
        }
        else{
            $all_categories =  Category::withCount('posts')->orderBy('posts_count','desc')->get();
            Cache::put('cats',$all_categories,30);
        }
            $view->with('popular_posts',Post::orderBy('views','desc')->limit(3)->get());
            $view->with('all_categories', $all_categories);
        });
    }
}

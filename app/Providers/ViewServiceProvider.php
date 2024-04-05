<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('welcome', function ($view) {
            $featuredPosts = Post::latest()->take(6)->get();
            $view->with('featuredPosts', $featuredPosts);
        });
        View::composer('posts.index', function ($view) {
            $posts = Post::orderBy('created_at', 'desc')->get();
            $view->with('posts', $posts);
        });
    }

}

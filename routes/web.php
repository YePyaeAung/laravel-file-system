<?php

use Illuminate\Support\Facades\Route;
use App\Models\Blog;
/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/

Route::get('/blogs', function () {
    $blogs = Blog::all();
    return view('all-blogs', [
        'blogs' => $blogs
    ]);
});

Route::get('/blogs/{blog}', function ($slug) {
    $blog_content = Blog::find($slug);
    return view('single-blog', [
        'blog' => $blog_content
    ]);
})->where('blog', '[A-z\d\-]+');


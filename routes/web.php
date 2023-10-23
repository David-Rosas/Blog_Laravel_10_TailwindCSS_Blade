<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    $posts = Post::latest();

    if ($posts) {
        $posts
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }
    return view(
        'posts',
        [
            'posts' => $posts->get(),
            'categories' => Category::all(),
        ]
    );
})->name('home');

Route::get('post/{post:slug}', function (Post $post) {
    return view('post', ["post" => $post]);
});

Route::get('category/{category:slug}', function (Category $category) {
    return view('posts', [
        "posts" => $category->posts->load(['category', 'author']),
        "currentCategory" => $category,
        'categories' => Category::all(),
    ]);
})->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        "posts" => $author->posts->load(['category', 'author']),
        'categories' => Category::all(),
    ]);
});

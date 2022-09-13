<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index () {
        $categories = Category::all();
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        $likedUsers = Post::withCount('likedUsers')->orderBy('liked_users_count','DESC')->get()->take(6);
        return view('main.index', compact('posts', 'randomPosts', 'likedUsers', 'categories'));
    }
}

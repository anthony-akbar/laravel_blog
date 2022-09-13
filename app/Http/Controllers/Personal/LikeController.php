<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\StoreRequest;
use App\Http\Requests\Admin\Comment\UpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class LikeController extends Controller
{
    public function index(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return redirect()->back();
    }


}

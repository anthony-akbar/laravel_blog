<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Post;

class LikedController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->likedPosts;
        return view('personal.liked.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::firstOrCreate($data);
        return redirect()->route('admin.category.index');
    }
    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('admin.category.show' ,compact('category'));
    }

    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }
    public function edit(Category $category) {
        return view('admin.category.edit', compact('category'));
    }
    public function destroy(Post $post) {
        auth()->user()->likedPosts()->detach($post->id);
        return redirect()->route('personal.liked.index');
    }
}

<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\StoreRequest;
use App\Http\Requests\Admin\Comment\UpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index()
    {
        $comments = auth()->user()->comments;
        return view('personal.comment.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Post $post, StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        Comment::create($data);
        return redirect()->route('post.show', $post->id);
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
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}

<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostServices
{
    public function store($data)
    {
        try{
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tagIds);
        }catch (\Exception $exception){
            abort(404);
        }
    }

    public function update($data, $post)
    {
        try{
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post->update($data);
            $post->tags()->sync($tagIds);

            return $post;
        }catch (\Exception $exception){
            abort(404);
        }
    }
}

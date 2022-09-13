@extends('layouts.main')

@section('content')

    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->Title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{ $date->translatedFormat('F') }} {{ $date->day }},
                {{ $date->year }}• {{ $date->format('H:i') }} • {{ $post->comments->count() }} Коментария</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!! $post->Content !!}
                    </div>
                    <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('storage/' . $post->preview_image) }}" alt="featured image" class="w-100">
                    </section>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="py-3">
                        @auth()
                            <form action="{{ route('post.like', $post->id) }}" method="post">
                                @csrf
                                <span style="font-size: 15px">{{ $post->liked_users_count }}</span>
                                <button class="border-0 bg-transparent" type="submit">
                                    @if(auth()->user()->likedPosts->contains($post->id))
                                        <i class="fas fa-heart" style="color:red; font-size: 15px"></i>
                                    @else
                                        <i class="far fa-heart" style="font-size: 15px"></i>
                                    @endif
                                </button>
                            </form>
                        @endauth
                        @guest()
                            <span style="font-size: 15px">{{ $post->liked_users_count }}</span>
                            <i class="far fa-heart" style="font-size: 15px"></i>
                        @endguest
                    </section>
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                    <img src="{{ asset('storage/' . $relatedPost->main_image) }}" alt="related post" class="post-thumbnail">
                                    <p class="post-category">{{ $relatedPost->category->Title }}</p>
                                    <a href="{{ route('post.show', $relatedPost->id) }}"><h5
                                            class="post-title">{{ $relatedPost->Title  }}</h5></a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <section class="comment-list mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">Коментарии</h2>

                        @foreach($post->comments as $commentss)
                            <div class="comment-text mb-3">
                    <span class="username text-black-50">
                      <span class="text-muted float-right">{{ $commentss->dateAsCarbon->diffForHumans() }}</span>
                        <div>{{ $commentss->user->name }}</div>
                    </span>
                                {{ $commentss->comment}}
                            </div>
                        @endforeach
                    </section>

                    @auth()
                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Оставить коментарий</h2>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Comment</label>
                                        <textarea name="comment" id="comment" class="form-control"
                                                  placeholder="Напишите коментарий!"
                                                  rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Отправить" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                            @endauth
                        </section>
                </div>
            </div>
        </div>
    </main>

@endsection

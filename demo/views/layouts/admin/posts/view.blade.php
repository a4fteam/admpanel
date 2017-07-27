@extends('admpanel::layouts.admin.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-9">
            <div class="post-body">
                <img src="{{ starts_with($post->img, ['http://', 'https://']) ? '' : '/vendor/admpanel/assets/upload/post/' }}{{ $post->img }}" alt="" style="max-width: 100%;" class="post-image">
                <article>
                    <div class=" post-content">
                        <div class="">
                            <h1 class="">{{ $post->title }}</h1>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="">
                                        {!! $post->content !!}
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div>
                                    <i class="fa fa-square"></i>

                                    <a href="{{ route('category', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                                </div>
                                <div>
                                    <i class="fa fa-clock-o"></i>
                                    Опубликовано: {{ hdate($post->published_at) }}
                                    <small class="text-muted">({{ date('d.m.Y', strtotime($post->published_at)) }})</small>
                                </div>
                                <div>
                                    Автор: {{ $post->user->name }}
                                </div>
                                <div>
                                    @include('admpanel::layouts.admin.posts.tags-list', ['tags' => $post->tags])
                                </div>
                            </div>

                        </div>
                        <div class="">
                            @include('admpanel::layouts.admin.posts.related', ['post' => $post])
                        </div>
                    </div>
                </article>
                @include('admpanel::layouts.admin.posts.comments')
            </div>
        </div>
    </div>
</div>
@stop

@section('meta')
<link rel="author" href="{{ $post->user->name or '' }}" />
@stop
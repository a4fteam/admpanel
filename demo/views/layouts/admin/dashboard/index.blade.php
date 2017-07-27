@extends('admpanel::layouts.admin.index')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Вы вошли как
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><span class="text-muted">Логин: </span> <span>{{ auth()->user()->name }}</span></li>
                            <li><span class="text-muted">Регистрация: </span> <span>{{ auth()->user()->created_at }}</span></li>
                            <li><span class="text-muted">Мой IP: </span> <span>{{ Request::ip() }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('root-posts') }}">Статьи</a>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <span class="text-muted"><a href="{{ route('root-posts') }}">Активные</a>:</span>
                                <span class="label label-success">{{ $posts_active }}</span>
                            </li>
                            <li>
                                <span class="text-muted">
                                    <a href="{{ route('root-posts', ['status' => 'moderation']) }}">Модерация</a>:</span>
                                <span class="label label-{{ ($posts_moderation > 0) ? 'danger' : 'success' }}">{{ $posts_moderation }}</span>
                            </li>
                            <li>
                                <span class="text-muted">
                                    <a href="{{ route('root-posts', ['status' => 'draft']) }}">Черновик</a>:</span>
                                <span class="label label-success">{{ $posts_draft }}</span>
                            </li>
                            <li><span class="text-muted">Всего:</span> <span class="label label-success">{{ $posts_total }}</span></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('root-users') }}">Пользователи</a>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><span class="text-muted">Активированные:</span> <span class="label label-success">{{ $users_active }}</span></li>
                            <li><span class="text-muted">Неактивированные:</span> <span class="label label-success">{{ $users_inactive }}</span></li>
                            <li><span class="text-muted">Всего:</span> <span class="label label-success">{{ $users_total }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ route('root-posts') }}">Последние статьи</a></div>
                        <ul class="list-group">
                            @foreach($latest_posts as $latest)
                                <li class="list-group-item">
                                    <a href="{{ route('root-post-edit', ['post_id' => $latest->id]) }}" class="badge">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('view', ['slug' => $latest->slug]) }}" target="_blank">
                                        {{ $latest->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ route('root-posts') }}">Популярные статьи</a></div>
                        <ul class="list-group">
                            @foreach($popular_posts as $popular)
                                <li class="list-group-item">
                                    <a href="{{ route('root-post-edit', ['post_id' => $popular->id]) }}" class="badge">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <span class="label label-danger">{{ $popular->views }}</span>
                                    <a href="{{ route('view', ['slug' => $popular->slug]) }}" target="_blank">
                                        {{ $popular->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>

    </div>
@stop
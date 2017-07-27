@extends('admpanel::layouts.admin.index')

@section('content')
    <div>
        <h1>{{ $title }}</h1>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <div class="sidebar-nav">
                    <a href="{{ route('root-posts-new') }}" class="btn btn-block btn-success">Новая статья</a>
                    <br />
                    <div>
                        <form method="GET" action="{{ route('root-posts') }}">
                            @foreach($url_params as $url_key=>$url_param)
                                <input type="hidden" name="{{ $url_key }}" value="{{ $url_param }}" />
                            @endforeach
                            <input type="text" name="q" value="{{ $q }}" placeholder="Быстрый поиск..." class="form-control" />
                        </form>
                    </div>
                    <br />
                    <ul class="nav nav-pills nav-stacked">
                        <li class="{{ $status == 'all' ? 'active' : '' }}">
                            <a href="{{ route('root-posts') }}">Все статьи</a>
                        </li>
                        <li class="{{ $status == 'draft' ? 'active' : '' }}">
                            <a href="{{ route('root-posts', ['status' => 'draft']) }}">Черновики</a>
                        </li>
                        <li class="{{ $status == 'moderation' ? 'active' : '' }}">
                            <a href="{{ route('root-posts', ['status' => 'moderation']) }}">Модерация</a>
                        </li>
                        <li class="{{ $status == 'refused' ? 'active' : '' }}">
                            <a href="{{ route('root-posts', ['status' => 'refused']) }}">Откланенные</a>
                        </li>
                        <li class="{{ $status == 'deleted' ? 'active' : '' }}">
                            <a href="{{ route('root-posts', ['status' => 'deleted']) }}">Удаленные</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Сатья</th>
                                <th>Опубликовано</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                @include('admpanel::layouts.admin.posts._post')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    @if($posts->lastPage() > 1)
                        {!! $posts->render() !!}
                    @endif
                </div>
            </div>
        </div>


    </div>
@stop

@extends('admpanel::layouts.admin.index')

@section('content')
<!--<div class="container">-->

<!--<div class="container">-->
<div>
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('root-settings-counters-save') }}" method="POST">
                {!! csrf_field() !!}
                <div>
                    <div class="form-group">
                        <label for="inputGoogle">Google counter ID <span
                            class="text-muted">(i.e.: UA-12345678-1)</span></label>
                            <input type="text" name="google_analytics" id="inputGoogle" class="form-control"
                            value="{{ Conf::get('seo.counters.google_analytics', '') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputYandex">Yandex Metrika ID <span
                                class="text-muted">(i.e.: 12345678)</span></label>
                                <input type="text" name="yandex_metrika" id="inputYandex" class="form-control"
                                value="{{ Conf::get('seo.counters.yandex_metrika', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputMeta">Другие дополнительные HTML Meta-Tags</label>
                                <textarea name="more_meta" id="inputMeta" class="form-control">{{ Conf::get('seo.more_meta', '') }}</textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('root-settings') }}" class="btn btn-default">Отменить</a>
                            <input type="submit" value="Сохранить" class="btn btn-success"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @stop
@extends('admpanel::layouts.admin.index')

@section('content')

<!--<div class="container">-->
<div>
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('root-settings-website-save') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="inputSiteName">Имя сайта</label>
                    <input type="text" value="{{ Conf::get('app.sitename') }}" name="sitename" class="form-control" id="inputSiteName">
                </div>
                <div class="form-group">
                    <label for="inputSiteUrl">URL сайта</label>
                    <input type="text" value="{{ Conf::get('app.url') }}" name="siteurl" class="form-control" id="inputSiteUrl">
                </div>
                <div class="form-group">
                    <label for="inputSiteTitle">Title сайта</label>
                    <input type="text" value="{{ Conf::get('seo.default.seo_title') }}" name="site_title" class="form-control" id="inputSiteTitle">
                </div>
                <div class="form-group">
                    <label for="inputSiteDescription">Description сайта</label>
                    <textarea name="site_description" id="inputSiteDescription" class="form-control">{{ Conf::get('app.description') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="inputIndexAllow">Индексировать всё</label>
                            <select name="seo_index" class="form-control" id="inputIndexAllow">
                                <option value="index, follow" {{ (Conf::get('seo.index') == 'index, follow') ? 'selected' : '' }}>index, follow</option>
                                <option value="index, nofollow" {{ (Conf::get('seo.index') == 'index, nofollow') ? 'selected' : '' }}>index, nofollow</option>
                                <option value="noindex, follow" {{ (Conf::get('seo.index') == 'noindex, follow') ? 'selected' : '' }}>noindex, follow</option>
                                <option value="noindex, nofollow" {{ (Conf::get('seo.index') == 'noindex, nofollow') ? 'selected' : '' }}>noindex, nofollow</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSeoDescription">Meta Description по умолчанию</label>
                    <input type="text" value="{{ Conf::get('seo.default.seo_description') }}" name="seo_description" class="form-control" id="inputSeoDescription">
                </div>
                <div class="form-group">
                    <label for="inputSeoKeywords">Meta Keywords по умолчанию</label>
                    <input type="text" value="{{ Conf::get('seo.default.seo_keywords') }}" name="seo_keywords" class="form-control" id="inputSeoKeywords">
                </div>

                <div class="text-right">
                    <a href="{{ route('root-settings') }}" class="btn btn-default">Отменить</a>
                    <input type="submit" value="Сохранить" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
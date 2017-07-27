@extends('admpanel::layouts.admin.index')

@section('content')
    <div>
        <h1>{{ $title }}</h1>

        <form action="{{ $save_url }}" enctype="multipart/form-data" method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="form-group">
                        <label for="inputTitle">Название</label>
                        <input id="inputTitle" type="text" value="{{ $post->title or old('title') }}" class="form-control" name="title">
                    </div>
                    @if(!is_null($post))
                        <div class="well">
                            <div>
                                <span class="text-muted">URL:</span>
                                <a href="{{ route('view', ['slug' => $post->slug]) }}" target="_blank">
                                    {{ route('view', ['slug' => $post->slug]) }}
                                </a>
                            </div>
                            <div>
                                <hr />
                                <div class="post-options">
                                    <a href="{{ route('view', ['slug' => $post->slug]) }}" target="_blank"
                                       class="brown-text">Просмотр</a>
                                    <a href="{{ route('root-post-edit', ['post_id' => $post->id]) }}"
                                       class="brown-text">Редактирование</a>
                                    @if($post->status == 'active')
                                        <a href="{{ route('root-post-to-draft', ['post_id' => $post->id]) }}"
                                           class="brown-text">В черновики</a>
                                    @else
                                        <a href="{{ route('root-post-to-active', ['post_id' => $post->id]) }}"
                                           class="brown-text">Опубликовать</a>
                                    @endif
                                    @if($post->status != 'deleted')
                                        <a href="{{ route('root-post-to-deleted', ['post_id' => $post->id]) }}"
                                           class="brown-text">Удалить</a>
                                    @else
                                        <a href="{{ route('root-post-to-draft', ['post_id' => $post->id]) }}"
                                           class="brown-text">Вернуть</a>
                                    @endif
                                    @if($post->is_pinned)
                                        <a href="{{ route('root-post-unpin', ['post_id' => $post->id]) }}"
                                           class="brown-text">Открепить</a>
                                    @else
                                        <a href="{{ route('root-post-pin', ['post_id' => $post->id]) }}"
                                           class="brown-text">Прикрепить</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="inputExcerpt">Выдержка</label>
                        <textarea id="inputExcerpt"
                                  name="excerpt" class="form-control">{!! $post->excerpt or old('excerpt')  !!} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputContent">Content</label>
                        <textarea  class="edit" name="content">{!! $post->content or old('content')  !!} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputSEOTitle">SEO Title</label>
                        <input id="inputSEOTitle" type="text" value="{{ $post->seo_title or old('seo_title') }}" class="form-control" name="seo_title">
                    </div>
                    <div class="form-group">
                        <label for="inputSEODescription">SEO Description</label>
                        <textarea id="inputSEODescription" name="seo_description" class="form-control">{{ $post->seo_description or old('seo_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputSEOKeywords">SEO Keywords</label>
                        <input id="inputSEOKeywords" type="text" class="form-control"
                               value="{{ $post->seo_keywords or old('seo_keywords') }}" name="seo_keywords">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="form-group">
                        <label for="inputCategory">Категории</label>
                        <select name="category_id" id="inputCategory" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ (!empty($post) && $post->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="inputPage_id">Страница</label>
                            <select class="form-control" name="page_id">
                                <option selected>выберите</option>
                                @foreach($pages as $page)
                                    <option value='{{ $page->id }}'>{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="inputImg">Миниатюра</label>
                        @if(!empty($post) && !empty($post->img))
                            <br />
                            <img src="/vendor/admpanel/assets/upload/post/{{ $post->img }}" alt="">
                        @endif
                        <input type="file" id="inputImg" name="img" class="" >
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Статус</label>
                        <select name="status" id="inputStatus" class="form-control">
                            <option value="draft" {{ (!empty($post) && $post->status == 'draft') ? 'selected' : '' }}>Шаблон</option>
                            <option value="active" {{ (!empty($post) && $post->status == 'active') ? 'selected' : '' }}>Активная</option>
                            <optgroup label="Additional">
                                <option value="moderation" {{ (!empty($post) && $post->status == 'moderation') ? 'selected' : '' }}>Модерация</option>
                                <option value="deleted" {{ (!empty($post) && $post->status == 'deleted') ? 'selected' : '' }}>Удалено</option>
                                <option value="refused" {{ (!empty($post) && $post->status == 'refused') ? 'selected' : '' }}>Отказано</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputPublishedAt">Опубликовано</label>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text"
                                   id="inputPublishedAt"
                                   value="{{ (!empty($post) ? $post->published_at : date('Y-m-d H:i:s')) }}"
                                   name="published_at"
                                   class="form-control">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputTags">Тэги</label>
                        <input type="text"
                               id="inputTags"
                               name="tags"
                               value="{{ (!empty($post) ? $post->tags->implode('tag', ', ') : old('tags'))  }}"
                               class="form-control">

                        <div class="well well-sm tags-list">
                            <a class="btn btn-link" onclick="$('#popularTags').slideToggle(100);">Популярные тэги</a>
                            <div id="popularTags" style="display:none;">
                                @foreach($tags as $tag)
                                    <a href="#{{ $tag->tag }}" class="add-tag" data-tag="{{ $tag->tag }}">{{ $tag->tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="ping" value="1"> Ping Blog Services
                        </label>
                    </div>
                    <hr/>
                    <div>
                        <input type="submit" value="Сохранить" class="btn btn-block btn-success" >
                    </div>
                    <div class="text-center">
                        <a href="{{ route('root-posts') }}" class="btn btn-default btn-block">Отмена</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js-bottom')
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins//moment/moment.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/trumbowyg/trumbowyg.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/trumbowyg/plugins/upload/trumbowyg.upload.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/trumbowyg/plugins/base64/trumbowyg.base64.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/post.js') }}"></script>

@stop

@section('css')
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css') }}">
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-tokenfield/css/tokenfield-typeahead.min.css') }}">
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/bootstrap-file-input/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/js/plugins/trumbowyg/ui/trumbowyg.min.css') }}">
@stop

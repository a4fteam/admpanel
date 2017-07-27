@extends('admpanel::layouts.admin.index')

@section('content')
<div class="col-sm-12  col-md-3 col-lg-4">
                <a href="{{ route('page.create') }}" class="btn btn-block btn-success">Новая страница</a>
                <div class="text-right col-md-12"><b>Страницы:</b><i class="badge">{{$count}}</i> </div>
                <br />
                <br/>
                    @if( count($page) == 0 )
                    <div class="post-preview col-md-12 text-center">
                        <h2 class="post-title">
                            Пока не добалено не одной страницы
                        </h2>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-8">
                            <div><h4>{{ $page->title }}</h4></div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="col-lg-4 text-right">
                                <a class="btn btn-success" href="{{ route('page.active', ['id' => $page->id]) }}">
                                    <i class="fa fa-check"></i>
                                </a>                     
                            </div>
                            <div class="col-lg-4 text-right">
                                <a href="{{ route('page.edit', ['id' => $page->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            </div>
                            <div class="col-lg-4 text-right"> 
                                <form action="{{ route('page.destroy', ['id' => $page->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class='btn btn-danger' type="submit">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span class="hidden-xs hidden-sm"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr/>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">{{$pagetitle}}</h2>
        </div>    
        <div class="panel-body">
<form class="form-horizontal" method="POST" action="{{ $save_url }}" name="form" >
 
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="put"/>
        <div class="form-group">
                <label class="col-xs-3 control-label">Название страницы</label>
                <div class="col-xs-9">
                    <textarea class="form-control" placeholder="" name="title" id="name">{{ $page->title }}</textarea>
                </div>
        </div>
        <div class="form-group">
                <label class="col-xs-3 control-label">Title(meta)</label>
                <div class="col-xs-9">
                    <textarea class="form-control"  name="meta_title" id="meta_title">{{$page->meta_title}}</textarea>
                </div>
        </div>
        <div class="form-group">
                <label class="col-xs-3 control-label">Description(meta)</label>
                <div class="col-xs-9">
                    <textarea class="form-control"  name="meta_description" id="meta_description">{{$page->meta_description}}</textarea>
                </div>
        </div>
        <div class="form-group">
                <label class="col-xs-3 control-label">Keywords(meta)</label>
                <div class="col-xs-9">
                    <textarea class="form-control"  name="meta_keywords" id="meta_keywords">{{$page->meta_keywords}}</textarea>
                </div>
        </div>
        <div class="form-group">
                <label class="col-xs-3 control-label">html</label>
                <div class="col-xs-9">
                    <textarea class="form-control markItUp"  name="description" id="description" cols="85" rows="7">{{$page->description}}</textarea>
                </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input class="btn btn-success" name="submit" type="submit" value="Сохранить">
                <a href="{{ route('page.index') }}" class="btn btn-default">Назад</a>
            </div>
        </div> 
    </form>
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error }}</li>
            @endforeach
        </ul>
    @endif
        </div>
    </div>
</div>
@stop 
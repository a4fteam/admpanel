@extends('admpanel::layouts.admin.index')

@section('content')
<div class="col-sm-12  col-md-3 col-lg-3">
                <a href="{{ route('category.create') }}" class="btn btn-block btn-success">Новая категория</a>
                
                <div class="text-right col-md-12"><b>Категории:</b><i class="badge">{{$count}}</i> </div>
                <br />
                <br/>
                    @if( count($categorys) == 0 )
                    <div class="post-preview col-md-12 text-center">
                        <h2 class="post-title">
                            Пока не добалено не одной категории
                        </h2>
                    </div>
                    @endif
                @foreach($categorys as $category)
                    <div class="row">
                        <div class="col-lg-8">
                            <div><h4>{{ $category->name }} <span
                                            class="label label-{{ $category->num == 0 ? 'danger' : 'success' }}">{{ $category->num }}</span>
                                </h4></div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="col-lg-6 text-right">
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            </div>
                            <div class="col-lg-6 text-right"> 
                                <form action="{{ route('category.destroy', ['id' => $category->id]) }}" method="POST" >
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
                @endforeach
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">{{$pagetitle}}</h2>
        </div>    
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ $save_url }}" name="form" >
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-xs-3 control-label">Название категории</label>
                    <div class="col-xs-9">
                        <input class="form-control" placeholder="Название категории" value="{{ old('name', '') }}"  name="name" type="text" id="name" size="30" maxlength="20">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Краткое описание</label>
                    <div class="col-xs-9">
                        <textarea class="form-control" placeholder="Краткое описание категории" name="description" id="description" cols="85" rows="7">{{  old('description', '') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Title(SEO)</label>
                    <div class="col-xs-9">
                        <input class="form-control" placeholder="" name="seo_title" id="meta_title" value="{{  old('seo_title', '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Description(SEO)</label>
                    <div class="col-xs-9">
                        <textarea class="form-control" placeholder="" name="seo_description" id="meta_description">{{ old('seo_description', '') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Keywords(SEO)</label>
                    <div class="col-xs-9">
                        <input class="form-control" placeholder="" name="seo_keywords" id="meta_keywords" value="{{ old('seo_keywords', '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <button class='btn btn-success' name="submit" type="submit">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span class="hidden-xs hidden-sm">Добавить</span>
                        </button>
                        <a href="{{ route('category.index') }}" class="btn btn-default">Назад</a>
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
@endsection
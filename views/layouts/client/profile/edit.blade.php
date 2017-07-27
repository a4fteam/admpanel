@extends('admpanel::layouts.admin.index')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">{{$pagetitle}}</h2>
        </div>    
        <div class="panel-body">
<form class="form-horizontal"  method="POST" action="{{route('profile.update', ['id' => $profile->id])}}" name="form"  enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="put"/>
        <div class="form-group">
                <label class="col-xs-3 control-label">Логин</label>
                <div class="col-xs-9">
                    <input class="form-control" value="{{$profile->name}}" name="name" type="text" id="name">
                </div>    
        </div>
         <div class="form-group">
                <label class="col-xs-3 control-label">Введите EMAIL</label>
                <div class="col-xs-9">
                    <input class="form-control" value="{{$profile->email}}" name="email" type="text" class="value" id="email">
                </div>    
         </div>
        <div class="row">
                    <label class="col-xs-3 control-label">Загрузите файл</label> 
                    <div class="col-xs-4">
                        <input type="file" name="avatar" class="" id="inputAvatar"/>                  
                    </div>
                    <div class="col-xs-5">
                        <i class="glyphicon glyphicon-arrow-left"></i> Выберите аватар. <p class="help-block">Размер изображения 150x150px, не более 200Кб</p>
                    </div>
                    <div class="col-md-9 col-md-offset-3">
                        <img src = "/vendor/admpanel/assets/upload/avatar/{{ $profile->avatar }}" style="width: 150px;height: 150px" >                 
                    </div>
                    
        </div>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                   <input class="btn btn-primary" name="submit" type="submit" value="Сохранить редактирование">
                   <a href="{{ route('profile.show', ['id' => $profile->id]) }}" class="btn btn-default">Назад</a>
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

@section('js-bottom')
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/settings/plugins/bootstrap-file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/slider.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/settings/plugins/bootstrap-file-input/css/fileinput.min.css') }}">
@stop
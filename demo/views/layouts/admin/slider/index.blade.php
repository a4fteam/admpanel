@extends('admpanel::layouts.admin.index')

@section('content')
    <h1>{{ $pagetitle }}</h1>
        <br />
        
        <div class="row">
            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">{{$pagetitle}}</h2>
                    </div>    
                    <div class="panel-body">
                        <form class="form-horizontal"  method="post" action="{{ route('slider.store') }}" name="form" files="true"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-xs-12">Введите название(alt)</label>
                                    <div class="col-xs-12">
                                            <input class="form-control" placeholder="Название(alt)" value="{{ old('alt') }}"  name="alt" type="text" id="alt" >
                                     </div>   
                                </div>
                                <div class="row">
                                     <label class="col-xs-12">Загрузите картинку</label> 
                                    <div class="col-md-8">
                                        <input type="file" name="files" class="" id="inputSlide">
                                    </div>
                                    <div class="col-md-4">
                                        <i class="glyphicon glyphicon-arrow-left"></i> Выберите картинку. <p class="help-block">Файлы форматов jpeg,bmp,png не более 2000Кб</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-3 col-xs-9">
                                        <button class='btn btn-success' name="submit" type="submit">
                                            <i class="glyphicon glyphicon-plus"></i>
                                             <span class="hidden-xs hidden-sm">Добавить</span>
                                        </button>
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
            <div class="col-sm-12 col-md-8 col-lg-8">
               <div class="text-right col-md-12"><b>Картинки слайдера:</b><i class="badge">{{$count}}</i> </div><br/><br/>
                    @if( count($sliders) == 0 )
                    <div class="post-preview col-md-12 text-center">
                        <h2 class="post-title">
                            Пока не добалено не одного изображения
                        </h2>
                    </div>
                    @endif
                    <div class="messages">
                    @if (! $sliders->isEmpty() )
                        @foreach ($sliders as $slider)
                            <div class="col-sm-6 col-md-4 col-lg-4 ">
                                <div id="panel" class="panel panel-default">
                                    <div class=" text-center panel-heading">
                                    {{ $slider->alt }}
                                    </div>
                                     <div class="panel-body">
                                        <div class="col-sm-12">
                                            <img src="/vendor/admpanel/assets/upload/slider/{{ $slider->img_name }}" style="width: 100%; height: 150px;" alt="">
                                        </div>
                                     <br />
                                    <div class="col-sm-12 padingtop">
                                        <div class="col-sm-6 margin-bottom">
                                            <a class="btn btn-primary btn-block" href="{{ route('slider.edit', ['id' => $slider->id]) }}">
                                                <i class="fa fa-pencil"></i>
                                                <span class="hidden-xs hidden-sm"></span>
                                            </a>
                                        </div>
                                        <div class="col-sm-6 margin-bottom">
                                            <form action="{{ route('slider.destroy', ['id' => $slider->id]) }}" method="POST" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class='btn btn-danger btn-block' type="submit">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span class="hidden-xs hidden-sm"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                         </div>
                                </div>
                            </div>
                        @endforeach
                    <div class="text-center">
                        {!! $sliders->render() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>  
@endsection  

@section('js-bottom')
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/settings/plugins/bootstrap-file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ url('/vendor/admpanel/assets/templates/admin/js/slider.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="{{ url('/vendor/admpanel/assets/templates/admin/settings/plugins/bootstrap-file-input/css/fileinput.min.css') }}">
@stop
@extends('admpanel::layouts.admin.index')

@section('content')

        <h1>{{ $pagetitle }}</h1>
        <br />
        
        <div class="row">
            <div class="col-sm-12  col-md-3 col-lg-3">
                <a href="{{ route('page.create') }}" class="btn btn-block btn-success">Новая страница</a>
                <div class="text-right col-md-12"><b>Страницы:</b><i class="badge">{{$count}}</i> </div>
                <br />
                <br/>
                    @if( count($pages) == 0 )
                    <div class="post-preview col-md-12 text-center">
                        <h2 class="post-title">
                            Пока не добалено не одной страницы
                        </h2>
                    </div>
                    @endif
                @foreach($pages as $page)
                    <div class="row">
                        <div class="col-lg-7">
                            <div><h4>{{ $page->title }}</h4></div>
                        </div>
                        <div class="col-lg-5 text-right">
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
                @endforeach
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                
            </div>
        </div>

  
@endsection


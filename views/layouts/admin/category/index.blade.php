@extends('admpanel::layouts.admin.index')

@section('content')
        <h1>{{ $pagetitle }}</h1>
        <br />
        
        <div class="row">
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
                
            </div>
        </div> 
@endsection  

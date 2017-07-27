<div class="text-right col-md-12"><b>Страницы:</b><i class="badge">{{$count}}</i> </div><br/>

<div class="col-md-12">
    <div class="panel panel-default">
                    <div class="panel-body">
    @if( count($pages) != 0  && ! $pages->isEmpty())
    <table class="table">
        <thead>
            <tr id="bold1">
                <td>Страница</td>
                <td>meta_title</td>
                <td>meta_description</td>
                <td>meta_keywords</td>
                <td>Действие</td>
            </tr>
        </thead>
        @foreach ($pages as $page)
        <tbody>
            <tr class="odd" role="row">
                <td>{{$page->title}}</td>
                <td>{{$page->meta_title}}</td>
                <td>{{$page->meta_description}}</td>
                <td>{{$page->meta_keywords}}</td>
                <td>
                    <div class="col-sm-4 text-right">
                        <a class="btn btn-success btn-block" href="{{ route('page.active', ['id' => $page->id]) }}">
                            <i class="fa fa-check"></i>
                            <span class="hidden-xs hidden-sm"></span>
                        </a>                     
                    </div>
                    <div class="col-sm-4 text-right">
                        <a class="btn btn-primary btn-block" href="{{ route('page.edit', ['id' => $page->id]) }}">
                            <i class="fa fa-pencil"></i>
                            <span class="hidden-xs hidden-sm"></span>
                        </a>              
                    </div>
                    <div class="col-sm-4 text-right">
                        
                        <form action="{{ route('page.destroy', ['id' => $page->id]) }}" method="POST" >
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class='btn btn-danger btn-block' type="submit">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span class="hidden-xs hidden-sm"></span>
                            </button>
                        </form>
                    </div>
                </td> 
            </tr>
        </tbody>
        @endforeach
    </table>
    <div class="text-center">
        {!! $pages->render() !!}
    </div>
    @else
    <div class="post-preview col-md-12 text-center">
        <h2 class="post-title">
            Пока не добалено ни одного сведения о компании
        </h2>
    </div>
    @endif

</div>
        </div>
    </div>

@extends('admpanel::layouts.admin.index')

@section('content')
<div class="container">
    {!! Notifications::byGroup('0')->toHTML() !!}
</div>
    <div class="container">
        <h1>{{ $title }}</h1>
        <br/>
        <div class="well well-sm text-right">
            <a href="{{ route('root-tags-clear-orphaned') }}" onclick="return confirm('Вы уверенны?');" class="btn btn-info">Clean Orphaned Tags</a>
        </div>
        <div class="">
            <ul class="list-group">
                @foreach($tags as $tag)
                    <li class="list-group-item">
                        <span class="badge" title="Posts count">{{ $tag->num }}</span>
                        <a class="brown-text" href="{{ route('tag', ['tag' => $tag->tag]) }}" target="_blank">
                            {{ $tag->tag }}
                        </a>&nbsp;
                        <a href="{{ route('root-tags-remove', ['tag_id' => $tag->id]) }}" onclick="return confirm('Вы действительно хотите удалить этот тег?');"><i class="fa fa-times"></i></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
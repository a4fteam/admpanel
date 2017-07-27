@extends('admpanel::layouts.admin.index')

@section('content')
<h1 class="text-center">{{$pagetitle}}</h1>
   <div class="container"> 
       <div class="row">
           <div class="col-md-6 col-md-offset-3">
               <div class="well">
                   @foreach($profiles as $profile)
                   <dl class="dl-horizontal">
                       @if( $profile->avatar == '0' )
                       <dd><img  src = '{{ url('/vendor/admpanel/assets/upload/avatar/default.png') }}' style="width: 150px;height: 150px"/></dd>
                       @else
                       <dd><img  src="/vendor/admpanel/assets/upload/avatar/{{ $profile->avatar }}" style="width: 150px;height: 150px"/></dd>
                       @endif  
                   </dl>
                   <dl class="dl-horizontal"> 
                       <dt>Логин</dt>
                       <dd>{{ ($profile->name) }}</dd>
                   </dl>
                   <dl class="dl-horizontal">
                       <dt>EMAIL</dt>
                       <dd>{{ ($profile->email) }}</dd>
                   </dl>
                   <dl class="dl-horizontal">
                       <div class="row text-center">
                            <div class="col-sm-12">
                                <a class="btn btn-primary" href="{{ route('profile.edit', ['id' => $profile->id]) }}">Редактировать</a>
                            </div>
                        </div>
                   </dl>
                    @endforeach
                    
               </div> 
           </div>
       </div>
  </div>
@stop 
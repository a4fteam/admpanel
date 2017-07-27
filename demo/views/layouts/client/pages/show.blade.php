@extends('admpanel::layouts.client.app')

@section('content')
<section class="container hidden-print">
    <div class="row">
        <div class="col-sm-12 image-fit jcarousel-wrapper">
            <div class="jcarousel" id="118555">
                <ul>
                    @foreach ($sliders as $slider)
                    <li>
                        <img src="/vendor/admpanel/assets/upload/{{ $slider->img_name }}" style="max-width: 100%;" alt="{{ $slider->alt }}">
                    </li>
                    @endforeach
                </ul>
                <a class="carouselmobile jcarousel-control-prev carousel-left" href="#"></a>
                <a class="carouselmobile jcarousel-control-next carousel-right" href="#"></a>
            </div>
            <p class="jcarousel-pagination"></p>
        </div>
    </div>   
</section>
<section class="container alex_content">
    <div class="row">
        <div class="col-sm-12">
            <div>
                @foreach ($pages as $page)
                    {!! $page->description !!}
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection 
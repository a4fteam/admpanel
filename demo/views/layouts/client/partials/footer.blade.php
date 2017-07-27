@section('footer_left_section')
	<div class="col-sm-12">
    	© <span>2016 - <?php echo date("Y"); ?> </span>Все права защищены.
    </div>
    <div class="col-sm-12">
        Cайт обслуживается web-студией <br><a href="http://a4f.team">A4Fteam</a>
    </div>
@endsection

@section('footer_center_section')
	<div class="col-sm-12">
    @include("admpanel::layouts.seo.yandex.search")
    @include("admpanel::layouts.seo.yandex.metrika_informer")
    @include("admpanel::layouts.seo.google.search")
    </div>
@endsection
@section('footer_right_section')
    <div class="col-sm-12 align-left">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <a class="alert-link" href=""></a>
    </div>
    <div class="col-sm-12 align-left">
        <i class="fa fa-envelope-o" aria-hidden="true"></i>
        <span><a class="alert-link" href=""></a></span>
    </div>
    <br>
    <br>
    <br>
    <div class="col-sm-12 align-left" style="color: red">
        <span>Контроль качества:</span>
    </div>
    <div class="col-sm-12 align-left" style="color: red">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <a class="alert-link" href="" style="color: red"></a>
    </div>
@endsection

@section('footer_bottom_section')
    <div class="col-sm-12 align-left">
        
    </div>
@endsection


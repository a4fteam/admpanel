<body style="
@if(Conf::has('appearance.bg.image'))
        background: url('/vendor/admpanel/assets/upload/appearance/{{ Conf::get('appearance.bg.image') }}')
        {{ Conf::get('appearance.bg.horizontal') }}
        {{ Conf::get('appearance.bg.vertical') }}
        {{ Conf::get('appearance.bg.repeat') }}
        {{ Conf::get('appearance.bg.is_fixed') }}
        ;
@endif
">
    <div id="content">
        @include('admpanel::layouts.templates.client.partials.navigation')
        @include('admpanel::layouts.templates.client.partials.content')
        <div class="to-top hidden-print"><span class="glyphicon glyphicon-upload"></span></div>
    </div>
    @include('admpanel::layouts.templates.client.partials.footer')
    
    <div class="transparent"></div>
</body>

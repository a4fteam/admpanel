    {!!Conf::get('seo.more_meta', '') !!}
    <meta name="robots" content="{!!Conf::get('seo.index')!!}" />
    <meta property="og:url" content="{!! Request::url() !!}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<title></title>-->
    @if(! empty($seo))
    	@if(!empty($seo['title']))
    		<title>{!! $seo['title'] !!}</title>
    		<meta property="og:title" content="{!! $seo['title'] !!}" />
			<meta name="twitter:title" content="{!! $seo['title'] !!}"/>
    	@endif
    	@if(! empty($seo['keywords']))
			<meta property="keywords" content="{!! $seo['keywords'] !!}" />
			<meta property="og:keywords" content="{!! $seo['keywords'] !!}" />
			<meta property="twitter:keywords" content="{!! $seo['keywords'] !!}">
    	@endif
    	@if(! empty($seo['description']))
			<meta name="description" content="{!! $seo['description'] !!}"/>
			<meta name="twitter:description" content="{!! $seo['description'] !!}"/>
			<meta property="og:description" content="{!! $seo['description'] !!}" />
    	@endif

    	@if(! empty($seo['img']))
    		<meta name="twitter:image" content="{!! $seo['img'][0] !!}"/>
    		<!--TODO: Для каждой картинки Добавить метатег с ссылкой на эту картинку-->
    		@foreach($seo['img'] as $img)
    			<meta property="og:image" content="{!! $img !!}" />
    		@endforeach

    	@endif
    @endif

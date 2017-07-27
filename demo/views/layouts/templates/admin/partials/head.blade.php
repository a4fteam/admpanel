<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ Conf::get('seo.default.seo_title') }}</title>
    		 
    <link rel="shortcut icon" href="/vendor/admpanel/assets/upload/{{ Conf::get('appearance.icon') }}" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/vendor/admpanel/assets/templates/admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('/vendor/admpanel/assets/templates/admin/css/sb-admin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ url('/vendor/admpanel/assets/templates/admin/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('/vendor/admpanel/assets/templates/admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" type="text/css" href="{{ url('/vendor/admpanel/assets/templates/admin/latest/markitup/skins/markitup/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/vendor/admpanel/assets/templates/admin/latest/markitup/sets/default/style.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Posts --><!-- Settings -->
    @yield('css')
<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
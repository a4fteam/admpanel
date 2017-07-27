    <header style="background: {{ Conf::get('appearance.header.bg', '#FFFFFF') }};">
        <nav class="navbar navbar-{{ Conf::get('appearance.menu.color', 'inverse') }}">
            <div class="navbar-header">
                <div id="logo" class="visible-sm visible-xs pull-left">
                    <a href="/"><img src="/vendor/admpanel/assets/upload/appearance/{{ Conf::get('appearance.logo') }}" alt="{{ Conf::get('app.sitename') }}" /></a>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                    <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
            </div>
            
            <div id="nav" class="collapse navbar-collapse navbar-responsive-collapse">
                <div id="main-nav">
                    <div class="container dropdown">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="hidden-sm hidden-xs"><a href="/"><img src="/vendor/admpanel/assets/upload/appearance/{{ Conf::get('appearance.logo') }}" alt="{{ Conf::get('app.sitename') }}" /></a></li>
                                @foreach($items as $item)
                                    <?php
                                        $uri = '/' . trim(Request::path(), '/');
                                    ?>
                                    <li class="{{ isset($menu_item_active) && $menu_item_active == $item->active_item ? 'active' : ($uri == $item->url) ? 'active' : '' }}">
                                        <a href="{{ $item->url }}" {{ $item->on_blank == 1 ? 'target="_blank"' : '' }}>
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

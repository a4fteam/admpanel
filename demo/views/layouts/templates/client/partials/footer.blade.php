<footer class="hidden-print">
    <hr>
    <div id="footernav" style="background: {{ Conf::get('appearance.footer.top_bg', '#ecf0f1') }}; color: {{ Conf::get('appearance.footer.top_text', '#2b4646') }};">
        <div class="container">
            <div class="row hide-xs">
                <section class="col-xs-4 col-sm-4" style="text-align: center;">
                    @yield('footer_left_section')
                    
                    <!--<a href="/"><img src="/upload/{{ Conf::get('appearance.logo') }}" alt="{{ Conf::get('app.sitename') }}" /></a>
                    <div class="col-sm-12 col-lg-6">
                        <h3 class="white-text">{{ Conf::get('app.sitename') }} - {{ Conf::get('seo.default.seo_title') }}</h3>
                        <p class="grey-text text-lighten-4">{!! nl2br(e(Conf::get('app.description'))) !!}</p>
                    </div>
                    -->
                </section>
                <section class="col-xs-4 col-sm-4" style="text-align: center;">
                    @yield('footer_center_section')
                </section>
                <section class="col-xs-4 col-sm-4" style="text-align: center;">
                    @yield('footer_right_section')
            
                </section>
            </div>
            <div class="row hide-xs">
                <section class="col-xs-12 col-sm-12" style="text-align: center;">
                    @yield('footer_bottom_section')
                </section>
                
            </div>

        </div>
    </div>
   <!--
    <div class="container" style="background: {{ Conf::get('appearance.footer.bottom_bg', '#c7dae5') }}; color: {{ Conf::get('appearance.footer.bottom_text', '#111111') }};">
        <div class="row">
            <div class="col-sm-12">
                © <span>2016</span>
Все права защищены.
            </div>
        </div>
    </div>
    -->
</footer>

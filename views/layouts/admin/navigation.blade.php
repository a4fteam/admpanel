
@section('topRightDropdownMenu')
<li>
    <a href="{{ route('profile.show', auth()->user()->id) }}"><i class="fa fa-fw fa-user"></i> Профиль</a>
</li>
<!--
<li>
    <a href="#"><i class="fa fa-fw fa-envelope"></i> Сообщения</a>
</li>
-->
<li>
    <a href="{{ url('/') }}"><i class="fa fa-fw fa-futbol-o"></i>Главная</a>
</li>
 @endsection

 @section('leftMainMenu')
 <li>
    <a href="{{ route('root-menu') }}"><i class="fa fa-fw fa fa-bars"></i> Меню</a>
</li>
<li>
    <a href="{{ route('page.index') }}"><i class="fa fa-fw fa-desktop"></i> Страницы</a>
</li>
<li>
    <a href="{{ route('slider.index') }}"><i class="fa fa-fw fa-picture-o"></i>Слайдер</a>
</li>
<li>
    <a href="{{ route('category.index') }}"><i class="fa fa-fw fa-folder-o"></i> Категории</a>
</li>
<li>
    <a href="{{ route('root-users') }}"><i class="fa fa-fw fa-users"></i> Пользователи</a>
</li>
<li>
    <a href="{{ route('root-posts') }}"><i class="fa fa-fw fa-newspaper-o"></i> Статьи</a>
</li>
<li>
    <a href="{{ route('root-tags') }}"><i class="fa fa-fw fa-tags"></i> Теги</a>
</li>
<li class="withChildren1">
     <a href="javascript:;" ><i class="fa fa-fw fa-gear"></i> Настройки <i class="fa fa-fw fa-caret-down"></i></a>
        <ul>
            <li>
                <a href="{{ route('root-settings-website') }}"><i class="fa fa-fw fa-globe"></i> Сайт</a>
            </li>
            <li>
                <a href="{{ route('root-settings-appearance') }}"><i class="fa fa-fw fa-leaf"></i> Внешний вид</a>
            </li>
            <li>
                <a href="{{ route('root-settings-counters') }}"><i class="fa fa-fw fa-area-chart"></i> Мета и Счетчики</a>
            </li>
            <li>
                <a href="{{ route('root-settings-social') }}"><i class="fa fa-fw fa-facebook"></i> Социальная интеграция</a>
            </li>
            <li>
                <a href="{{ route('root-settings-robots-txt') }}"><i class="fa fa-fw fa-file-text-o"></i> Robots.txt</a>
            </li>
            <li>
                <a href="{{ route('root-settings-sitemap') }}"><i class="fa fa-fw fa-sitemap"></i> Карта сайта</a>
            </li>
        </ul>
</li>
  @endsection

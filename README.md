1.Установка пакета
	1.1 если из локального репозитория
		1.1.1 в composer.json добавить:
				"repositories": [
			{
				"type": "path",
				"url": "packages/a4fteam/admpanel"
			}
		],
		И
		"require": {
			"a4fteam/admpanel": "*",
			"cviebrock/eloquent-sluggable": "^4.2",
			"gaaarfild/laravel-conf": "1.*",
			"garf/laravel-notifications": "2.*",
			"garf/laravel-title": "2.*",
			"jenssegers/date": "^3.2"
		},
		1.1.2 в командной строке composer update
	1.2 если с онлайн репозитория
		1.2.1 в командной строке composer require a4fteam/admpanel 
	
2.Добавить в config/app.php

    'providers' => [
        A4fteam\Admpanel\AdmPanelProvider::class,
        //https://github.com/gaaarfild/laravel-title
        Garf\LaravelTitle\LaravelTitleServiceProvider::class,
        //https://github.com/gaaarfild/laravel-conf
        Gaaarfild\LaravelConf\LaravelConfServiceProvider::class,
        //https://github.com/gaaarfild/laravel-notifications
        Garf\LaravelNotifications\LaravelNotificationsServiceProvider::class,
        //https://github.com/cviebrock/eloquent-sluggable
        Cviebrock\EloquentSluggable\ServiceProvider::class,
        //https://github.com/jenssegers/laravel-date
        Jenssegers\Date\DateServiceProvider::class,

    'aliases' => [
        'Title' => Garf\LaravelTitle\TitleFacade::class,
        'Conf' => Gaaarfild\LaravelConf\ConfFacade::class,
        'Notifications' => Garf\LaravelNotifications\NotificationsFacade::class,
        'Date' => Jenssegers\Date\Date::class,

3.php artisan vendor:publish --provider="A4fteam\Admpanel\AdmPanelProvider" -опубликование 
	3.1 php artisan migrate(установка миграций) затем php artisan db:seed(установка первичных значений)

login - test@mail.ru
password - 013666 

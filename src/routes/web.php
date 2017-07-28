<?php



Route::group(array('namespace' => 'A4fteam\Admpanel\Http\Controllers', 'middleware' => ['web']), function() {

    /*Клиентские маршруты*/

Route::post('/request/add', [
    'as'   => 'request-add',
    'uses' => 'RequestController@add']);

Route::get('/view/{slug}', [
        'as'   => 'view',
        'uses' => 'PostsController@view',
    ]);
Route::get('/tag/{tag}', [
        'as'   => 'tag',
        'uses' => 'PostsController@tag',
    ]);
Route::get('/category/{slug?}', [
        'as'   => 'category',
        'uses' => 'PostsController@index',
    ]);

/*
Route::get('/welcome', function () {
return view('welcome');
});*/

/*
 * Системные маршруты
 */

Route::get('login', ['uses' =>'AuthController@login', 'as' => 'login']);
Route::post('login', ['uses' =>'AuthController@postLogin', 'as' => 'postlogin']);
Route::get('/lk', ['uses' =>'HomeController@index',   'as' => 'dashboard']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/', [
    'uses' => 'IndexController@show',
]);
    Route::get('{url}', [
    'uses' => 'IndexController@show',
]);
Route::group(['middleware' => 'auth'], function () {
    //тут роуты только для админа + авторизация
    Route::group(['prefix' => 'lk'], function () {
        Route::get('category', [
            'as'   => 'category',
            'uses' => 'CategoryController@index',
        ]);
        Route::get('page', [
            'as'   => 'page',
            'uses' => 'PageController@index',
        ]);
        Route::get('slider', [
            'as'   => 'slider',
            'uses' => 'SliderController@index',
        ]);
        Route::get('page/active/{id}', [
            'as'   => 'page.active',
            'uses' => 'PageController@active',
        ]);
          Route::get('profile/{id}',
          ['as'   => 'profile.show',
          'uses' =>'ProfileController@show'])
           ->where(['id' => '[0-9]+']);
          Route::get('profile/edit/{id}',
          ['as'   => 'profile.edit',
          'uses' =>'ProfileController@edit'])
           ->where(['id' => '[0-9]+']);
          Route::put('profile/update/{id}',
          ['as'   => 'profile.update',
          'uses' =>'ProfileController@update'])
           ->where(['id' => '[0-9]+']);
        Route::resource('category', 'CategoryController');
        Route::resource('page', 'PageController');
        Route::resource('slider', 'SliderController');

        //=======SETTINGS=======//
        Route::get('/', [
            'as'   => 'root-index',
            'uses' => 'DashboardController@index',
        ]);
        Route::get('/settings', [
            'as'   => 'root-settings',
            'uses' => 'SettingsController@index',
        ]);

        Route::get('/settings/counters', [
            'as'   => 'root-settings-counters',
            'uses' => 'SettingsController@counters',
        ]);

        Route::post('/settings/counters/save', [
            'as'   => 'root-settings-counters-save',
            'uses' => 'SettingsController@countersSave',
        ]);

        Route::get('/settings/robots-txt', [
            'as'   => 'root-settings-robots-txt',
            'uses' => 'SettingsController@robotsTxt',
        ]);

        Route::post('/settings/robots-txt', [
            'as'   => 'root-settings-robots-txt-save',
            'uses' => 'SettingsController@robotsTxtSave',
        ]);

        Route::get('/settings/sitemap', [
            'as'   => 'root-settings-sitemap',
            'uses' => 'SettingsController@sitemap',
        ]);

        Route::post('/settings/sitemap', [
            'as'   => 'root-settings-sitemap-save',
            'uses' => 'SettingsController@sitemapSave',
        ]);

        Route::get('/settings/sitemap/generate', [
            'as'   => 'root-settings-sitemap-generate',
            'uses' => 'SettingsController@sitemapGenerate',
        ]);

        Route::get('/settings/website', [
            'as'   => 'root-settings-website',
            'uses' => 'SettingsController@website',
        ]);

        Route::post('/settings/website', [
            'as'   => 'root-settings-website-save',
            'uses' => 'SettingsController@websiteSave',
        ]);

        Route::get('/settings/appearance', [
            'as'   => 'root-settings-appearance',
            'uses' => 'SettingsController@appearance',
        ]);

        Route::post('/settings/appearance', [
            'as'   => 'root-settings-appearance-save',
            'uses' => 'SettingsController@appearanceSave',
        ]);

        Route::post('/settings/css', [
            'as'   => 'root-settings-css-save',
            'uses' => 'SettingsController@cssSave',
        ]);

        Route::get('/settings/social', [
            'as'   => 'root-settings-social',
            'uses' => 'SettingsController@social',
        ]);

        Route::post('/settings/social', [
            'as'   => 'root-settings-social-save',
            'uses' => 'SettingsController@socialSave',
        ]);

        Route::post('/settings/social-links', [
            'as'   => 'root-settings-social-links-save',
            'uses' => 'SettingsController@socialLinksSave',
        ]);

        Route::get('/settings/social-links/{index}/delete', [
            'as'   => 'root-settings-social-links-delete',
            'uses' => 'SettingsController@socialLinksDelete',
        ]);
        
         //=======POSTS=======//
        
        Route::get('/posts', [
            'as'   => 'root-posts',
            'uses' => 'PostsController@index',
        ]);

        Route::get('/posts/new', [
            'as'   => 'root-posts-new',
            'uses' => 'PostsController@newPost',
        ]);

        Route::get('/posts/edit/{post_id}', [
            'as'             => 'root-post-edit',
            'uses'           => 'PostsController@edit',
        ])->where(['post_id' => '[0-9]+']);

        Route::post('/posts/store/{post_id?}', [
            'as'             => 'root-posts-store',
            'uses'           => 'PostsController@store',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/pin/{post_id}', [
            'as'             => 'root-post-pin',
            'uses'           => 'PostsController@pin',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/unpin/{post_id}', [
            'as'             => 'root-post-unpin',
            'uses'           => 'PostsController@unpin',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/to-draft/{post_id}', [
            'as'             => 'root-post-to-draft',
            'uses'           => 'PostsController@toDraft',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/to-active/{post_id}', [
            'as'             => 'root-post-to-active',
            'uses'           => 'PostsController@toActive',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/to-deleted/{post_id}', [
            'as'             => 'root-post-to-deleted',
            'uses'           => 'PostsController@toDeleted',
        ])->where(['post_id' => '[0-9]+']);

        Route::get('/posts/to-category/{post_id}/{category_id}', [
            'as'             => 'root-post-to-category',
            'uses'           => 'PostsController@toCategory',
        ])->where(['post_id' => '[0-9]+', 'category_id' => '[0-9]+']);
        
        //=======TAGS=======//

        Route::get('/tags', [
            'as'   => 'root-tags',
            'uses' => 'TagsController@index',
        ]);

        Route::get('/tags/clear-orphaned', [
            'as'   => 'root-tags-clear-orphaned',
            'uses' => 'TagsController@clearOrphaned',
        ]);

        Route::get('/tags/remove/{tag_id}', [
            'as'            => 'root-tags-remove',
            'uses'          => 'TagsController@remove',
        ])->where(['tag_id' => '[0-9]+']);
        
        //=======USERS=======//

        Route::get('/users', [
            'as'   => 'root-users',
            'uses' => 'UsersController@index',
        ]);

        Route::get('/users/add', [
            'as'   => 'root-users-new',
            'uses' => 'UsersController@add',
        ]);

        Route::get('/users/edit/{user_id}', [
            'as'             => 'root-users-edit',
            'uses'           => 'UsersController@edit',
        ])->where(['user_id' => '[0-9]+']);

        Route::post('/users/save/{user_id?}', [
            'as'             => 'root-users-save',
            'uses'           => 'UsersController@store',
        ])->where(['user_id' => '[0-9]+']);
        
        //=======MENU=======//

        Route::get('/menu', [
            'as'   => 'root-menu',
            'uses' => 'MenuController@index',
        ]);

        Route::post('/menu', [
            'as'   => 'root-menu-save',
            'uses' => 'MenuController@store',
        ]);

        Route::get('/menu/remove/{menu_id}', [
            'as'             => 'root-menu-remove',
            'uses'           => 'MenuController@remove',
        ])->where(['menu_id' => '[0-9]+']);

        Route::get('/menu/up/{menu_id}', [
            'as'             => 'root-menu-up',
            'uses'           => 'MenuController@up',
        ])->where(['menu_id' => '[0-9]+']);

        Route::get('/menu/down/{menu_id}', [
            'as'             => 'root-menu-down',
            'uses'           => 'MenuController@down',
        ])->where(['menu_id' => '[0-9]+']);
    });
});

});


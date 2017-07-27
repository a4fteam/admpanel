<?php

namespace A4fteam\Admpanel\Src\Http\Controllers;

use A4fteam\Admpanel\Src\Http\Jobs\CreateSitemap;
use A4fteam\Admpanel\Src\Http\Controllers\Controller;
use Conf;
use Illuminate\Http\Request;
use Notifications;
use Title;
use Illuminate\Config;


class SettingsController extends Controller
{
    public function website()
    {
        $data = [
            'title' => 'Настройки : Сайт',
        ];
        Title::prepend('Настройки');
        Title::prepend($data['title']);
        return view('admpanel::layouts.admin.settings.website', $data);
    }

    public function websiteSave(Request $request)
    {
        Conf::set('app.sitename', $request->get('sitename'));
        Conf::set('app.url', $request->get('siteurl'));
        Conf::set('app.description', $request->get('site_description'));

        Conf::set('seo.index', $request->get('seo_index'));

        Conf::set('seo.default.seo_title', $request->get('site_title'));
        Conf::set('seo.default.seo_description', $request->get('seo_description'));
        Conf::set('seo.default.seo_keywords', $request->get('seo_keywords'));
        Notifications::add('Настройки сохранены', 'success');

        return redirect()->route('root-settings-website');
    }

    public function appearance()
    {
        $theme_css = public_path(config('files.theme_css'));
        if (!file_exists($theme_css)) {
            file_put_contents($theme_css, "/* Вставте сюда свой CSS  */ \r\n\r\n");
        }

        $theme_css_content = file_get_contents($theme_css);

        $data = [
            'title'      => 'Настройки : Внешний вид',
            'logo'       => Conf::get('appearance.logo', null),
            'icon'       => Conf::get('appearance.icon', null),
            'bg'         => Conf::get('appearance.bg.image', null),
            'theme_css'  => $theme_css_content,
            'active_tab' => request('tab', 'simple'),
        ];
        Title::prepend('Настройки :');
        Title::prepend($data['title']);

        return view('admpanel::layouts.admin.settings.appearance', $data);
    }

    public function appearanceSave(Request $request)
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $path     = public_path('/vendor/admpanel/assets/upload/appearance');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);

            Conf::set('appearance.logo', $filename);
        }
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');

            $path     = public_path('/vendor/admpanel/assets/upload/appearance');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);

            Conf::set('appearance.icon', $filename);
        }

        if ($request->hasFile('background')) {
            $file = $request->file('background');

            $path     = public_path('/vendor/admpanel/assets/upload/appearance');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);

            $bg = [
                'image'      => $filename,
                'horizontal' => $request->get('horizontal', 'left'),
                'vertical'   => $request->get('vertical', 'top'),
                'repeat'     => $request->get('repeat', 'repeat'),
                'is_fixed'   => $request->get('is_fixed', ''),
            ];

            Conf::set('appearance.bg', $bg);
        } else {
            Conf::set('appearance.bg.horizontal', $request->get('horizontal', 'left'));
            Conf::set('appearance.bg.vertical', $request->get('vertical', 'top'));
            Conf::set('appearance.bg.repeat', $request->get('repeat', 'repeat'));
            Conf::set('appearance.bg.is_fixed', $request->get('is_fixed', ''));
        }
        Conf::set('appearance.header.bg', $request->get('header_bg', '#FFFFFF'));
        Conf::set('appearance.menu.color', $request->get('menu_color', 'default'));

        Conf::set('appearance.footer.top_bg', $request->get('footer_top_bg', '#ecf0f1'));
        Conf::set('appearance.footer.top_text', $request->get('footer_top_text', '#2b4646'));
        Conf::set('appearance.footer.bottom_bg', $request->get('footer_bottom_bg', '#c7dae5'));
        Conf::set('appearance.footer.bottom_text', $request->get('footer_bottom_text', '#111111'));

        Notifications::add('Успешно сохранено', 'success');

        return redirect()->route('root-settings-appearance');
    }

    public function cssSave(Request $request)
    {
        $theme_css_content = $request->get('css');

        $theme_css = public_path(config('files.theme_css'));

        file_put_contents($theme_css, $theme_css_content);

        Notifications::add('Настройки CSS сохранены', 'success');

        return redirect()->route('root-settings-appearance', ['tab' => 'css']);
    }

    public function counters()
    {
        Title::prepend('Настройки');
        Title::prepend('Мета и Счетчики');

        $data = [
            'title' => Title::renderr(' : ', true),
        ];

        return view('admpanel::layouts.admin.settings.counters', $data);
    }

    public function countersSave()
    {
        $counters = [
            'google_analytics' => request('google_analytics', ''),
            'yandex_metrika'   => request('yandex_metrika', ''),
        ];
        Conf::set('seo.counters', $counters);
        Conf::set('seo.more_meta', request('more_meta', ''));
        Notifications::add('Counters info сохранено', 'success');

        return redirect()->route('root-settings-counters');
    }

    public function robotsTxt()
    {
        if (!file_exists(public_path('robots.txt'))) {
            file_put_contents(public_path('robots.txt'), '');
        }
        if (!file_exists(public_path('humans.txt'))) {
            file_put_contents(public_path('humans.txt'), '');
        }

        Title::prepend('Настройки');
        Title::prepend('robots.txt файл');

        $data = [
            'title'      => Title::renderr(' : ', true),
            'robots_txt' => file_get_contents(public_path('robots.txt')),
            'humans_txt' => file_get_contents(public_path('humans.txt')),
        ];

        return view('admpanel::layouts.admin.settings.robots-txt', $data);
    }

    public function robotsTxtSave()
    {
        file_put_contents(public_path('robots.txt'), request('robots_txt', ''));
        file_put_contents(public_path('humans.txt'), request('humans_txt', ''));
        Notifications::add('robots.txt и humans.txt файлы сохранены', 'success');

        return redirect()->route('root-settings-robots-txt');
    }

    public function sitemap()
    {
        $sitemap_filename = Conf::get('sitemap.filename', 'sitemap.xml', false);

        Title::prepend('Настройки');
        Title::prepend('Sitemap.xml файл');

        $data = [
            'title'            => Title::renderr(' : ', true),
            'sitemap_exists'   => file_exists(public_path($sitemap_filename)),
            'sitemap_filename' => $sitemap_filename,
        ];

        return view('admpanel::layouts.admin.settings.sitemap', $data);
    }

    public function sitemapSave(Request $request)
    {
        $old = Conf::get('sitemap.filename', 'sitemap.xml');
        $new = $request->get('sitemap_filename', 'sitemap.xml');

        if ($old != $new) {
            if (file_exists(public_path($old))) {
                unlink(public_path($old));
            }
            Conf::set('sitemap.filename', $new);
        }

        Notifications::add('Sitemap настройки сохранены', 'success');

        return redirect()->route('root-settings-sitemap');
    }

    public function sitemapGenerate()
    {
        $this->dispatch(new CreateSitemap());

        Notifications::add('Генерация карты сайта', 'info');

        return redirect()->route('root-settings-sitemap');
    }
    public function social()
    {
        
        $links = Conf::get('social.links', [], false);

        if (!isset($links[0]['url'])) {
            $links = [];
            Conf::set('social.links', $links);
        }
        
        $data = [
            'title'    => 'Настройки : Социальные сети',
            'services' => trans('socials.services'),
            'created'  => $links,
            
        ];
        Title::prepend('Настройки');
        Title::prepend($data['title']);

        return view('admpanel::layouts.admin.settings.social', $data);
    }

    public function socialSave(Request $request)
    {
        if (trim($request->get('vk_app_id')) != '') {
            Conf::set('social.vk.app_id', $request->get('vk_app_id'));
        }

        Conf::set('social.comments.vk.enabled', $request->has('comments_vk_enabled'));
        Conf::set('social.comments.vk.width', $request->get('comments_vk_width', 848));
        Conf::set('social.comments.vk.limit', $request->get('comments_vk_limit', 5));

        Conf::set('social.comments.facebook.enabled', $request->has('comments_facebook_enabled'));
        Conf::set('social.comments.facebook.width', $request->get('comments_facebook_width', 848));
        Conf::set('social.comments.facebook.limit', $request->get('comments_facebook_limit', 5));
        Conf::set('social.comments.facebook.color_scheme', $request->get('comments_facebook_color_scheme', 'light'));

        Notifications::add('Успешно сохранено', 'success');

        return redirect()->route('root-settings-social');
    }

    public function socialLinksSave(Request $request)
    {
        $socials = Conf::get('social.links');
        $socials[] = [
            'service'    => $request->get('service'),
            'url'        => $request->get('url'),
            'show_title' => $request->has('show_title'),
        ];

        Conf::set('social.links', $socials);

        Notifications::add('Успешно сохранено', 'success');

        return redirect()->route('root-settings-social');
    }

    public function socialLinksDelete($index)
    {
        $socials = Conf::get('social.links');

        unset($socials[$index]);

        Conf::set('social.links', $socials);

        Notifications::add('Успешно сохранено', 'success');

        return redirect()->route('root-settings-social');
    }
}

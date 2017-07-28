<?php

namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Controllers\Controller;
use A4fteam\Admpanel\Http\Models\Posts;
use A4fteam\Admpanel\Http\Models\User;
use Title;

class DashboardController extends Controller
{
    public function index()
    {
        Title::prepend('Админ панель');

        $data = [
            'title'            => Title::renderr(' : ', true),
            'posts_total'      => Posts::count(),
            'posts_active'     => Posts::where('status', 'active')->count(),
            'posts_draft'      => Posts::where('status', 'draft')->count(),
            'posts_moderation' => Posts::where('status', 'moderation')->count(),
            'users_total'      => User::count(),
            'users_active'     => User::where('active', '1')->count(),
            'users_inactive'   => User::where('active', '0')->count(),
            'latest_posts'     => Posts::active()->orderBy('published_at', 'desc')->limit(5)->get(),
            'popular_posts'    => Posts::active()->orderBy('views', 'desc')->limit(5)->get(),
        ];

        return view('admpanel::layouts.admin.dashboard.index', $data);
    }
}

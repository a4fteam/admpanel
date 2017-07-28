<?php

namespace A4fteam\Admpanel\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use A4fteam\Admpanel\Http\Models\Menu;

class TopNavComposer
{
    public function compose(View $view)
    {
        $items = Menu::where('position', 'top')->orderBy('sort', 'asc')->get();
        $view->with('items', $items);
    }
}

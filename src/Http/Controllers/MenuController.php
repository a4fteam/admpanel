<?php

namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Controllers\Controller;
use A4fteam\Admpanel\Http\Requests;
use A4fteam\Admpanel\Http\Models\Menu;
use A4fteam\Admpanel\Http\Models\Page;
use Notifications;
use Redirect;
use Title;

class MenuController extends Controller
{
    public function index()
    {
        Title::prepend('Меню');

        $data = [
            'pages' => Page::all(),
            'items' => Menu::orderBy('position', 'asc')->orderBy('sort', 'asc')->get(),
            'title' => Title::renderr(' : ', true),
        ];

        return view('admpanel::layouts.admin.menu.index', $data);
    }

    public function store(Requests\StoreMenuRequest $request, $id = null)
    {
        $menu = Menu::findOrNew($id);

        $menu->parent_id = 0;
        $menu->title = $request->get('title');
        $menu->page_id = $request->get('page_id');
        $menu->url = $request->get('url');
        $menu->position = $request->get('position', 'top');
        $menu->active_item = $request->get('active_item');
        $menu->on_blank = $request->has('on_blank');
        $menu->sort = $request->has('sort');
        $menu->save();

        Notifications::add('Пункт меню добавлен', 'success');

        return redirect()->route('root-menu');
    }

    public function remove($menu_id)
    {
        Menu::destroy($menu_id);

        Notifications::add('Пункт меню изменен', 'success');

        return Redirect::route('root-menu');
    }

    public function up($menu_id)
    {
        $this->_moveMenuItem($menu_id, '<');

        return redirect()->route('root-menu');
    }

    public function down($menu_id)
    {
        $this->_moveMenuItem($menu_id, '>');

        return redirect()->route('root-menu');
    }

    private function _moveMenuItem($menu_id, $operator)
    {
        $menu = Menu::find($menu_id);

        $order = ($operator == '>') ? 'asc' : 'desc';
        
        $neighbour = Menu::where('sort', $operator, $menu->sort)->orderBy('sort', $order)->first();

        if (empty($neighbour)) {
            return false;
        }

        $old_sort = $menu->sort;

        $menu->sort = $neighbour->sort;
        $neighbour->sort = $old_sort;

        $menu->save();
        $neighbour->save();

        return true;
    }
}

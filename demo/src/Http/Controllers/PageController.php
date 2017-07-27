<?php

namespace A4fteam\Admpanel\Src\Http\Controllers;

use A4fteam\Admpanel\Src\Http\Models\Page;
use Illuminate\Http\Request;
use Notifications;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pagetitle' => 'Страницы ',
            'pages' => Page::latest()->paginate(4),
            'count'     => Page::count(),
        ];
        return view('admpanel::layouts.admin.page.index', $data);

    }
    public function create()
    {
        $data = [
            'pagetitle' => 'Добавить страницу ',
            'page' => null,
            'pages' => Page::get(),
            'count'     => Page::count(),
            'save_url' => route('page.store'),
        ];
        return view('admpanel::layouts.admin.page.page', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
        Page::create($all);
        
        Notifications::add('Страница успешно сохранена', 'success');
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit($id)
    {  
        $page =Page::findOrfail($id);
        $data = [
            'pagetitle' => 'Редактирование сведений',
            'page' => $page,
            'count'     => Page::count(),
            'save_url' => route('page.update', ['id' => $page->id]),
        ];
        
        
        return view('admpanel::layouts.admin.page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $page = Page::findOrfail($id);
        $all     = $request->all();
        $page->update($all);
        
        Notifications::add('Страница успешно изменена', 'success');
        
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrfail($id);
        $page->delete();

        return back();
    }
    public function active($id)
    {
        $page=Page::find($id);
        $page->is_active=1;
        $page->save();
        return back();
    }
}

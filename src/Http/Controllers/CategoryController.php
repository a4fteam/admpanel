<?php
namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Models\ServiceCategory;
use Illuminate\Http\Request;
use Notifications;

class CategoryController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pagetitle' => 'Добавление категорий ',
            'categorys' => ServiceCategory::where('is_active', '=', 0)->latest()->paginate(20),
            'count'     => ServiceCategory::where('is_active', '=', 0)->count(),
        ];
        return view('admpanel::layouts.admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'pagetitle' => 'Добавить категорию ',
            'categorys' => ServiceCategory::where('is_active', '=', 0)->get(),
            'category' => null,
            'save_url' => route('category.store'),
            'count'     => ServiceCategory::where('is_active', '=', 0)->count(),
        ];
        return view('admpanel::layouts.admin.category.category', $data);
    }
    
    public function edit($id)
    {
        $category =ServiceCategory::findOrfail($id);
        $data = [
            'pagetitle' => 'Редактирование категории',
            'category' => $category,
            'save_url' => route('category.update', ['id' => $category->id]),
            'count'     => ServiceCategory::where('is_active', '=', 0)->count(),
        ];

        return view('admpanel::layouts.admin.category.edit', $data);
    }
    
    public function store(Request $request)
    {
        $all = $request->all();
        ServiceCategory::create($all);
        
        Notifications::add('Категория успешно сохранена', 'success');
        
        return redirect()->route('category.index');
    }


    
    public function update(Request $request, $id)
    {
        $category = ServiceCategory::findOrfail($id);
        $all      = $request->all();
        $category->update($all);
        
        Notifications::add('Категория успешно изменена', 'success');

        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $category = ServiceCategory::findOrfail($id);
        $category->delete();

        return back();
    }
}

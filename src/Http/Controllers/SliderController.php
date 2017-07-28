<?php

namespace A4fteam\Admpanel\Http\Controllers;

use Illuminate\Http\Request;
use A4fteam\Admpanel\Http\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pagetitle' => 'Добавление слайдов',
            'sliders' => Slider::where('is_active','=',0)->latest()->paginate(20),
            'count' => Slider::where('is_active','=',0)->count()
        ];
        return view('admpanel::layouts.admin.slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('files')){ 
            $file = $request->file('files');
            $alt = $request->get('alt');
            $path     = public_path('/vendor/admpanel/assets/upload/slider');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);
            Slider::create([
                        'img_name' => $filename,
                        'alt' => $alt,
                    ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrfail($id);
        $data = [
            'pagetitle' => 'Редактирование слайдера',
            'slider' => $slider,
            'count' => Slider::where('is_active','=',0)->count()
        ];
     
        return view ('admpanel::layouts.admin.slider.edit', $data);
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
        $slider = Slider::findOrfail($id);
        $all=$request->all();
            if($request->hasFile('files')) 
            {
            $file = $all['files'];    
            $path     = public_path('/vendor/admpanel/assets/upload/slider/');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);
            $all['img_name'] = $filename; 
            }
            $slider->update($all);
            
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrfail($id);
        $slider->delete();

        return back();
    }
}

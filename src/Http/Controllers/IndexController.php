<?php

namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Models\Page;
use A4fteam\Admpanel\Http\Models\Slider;
use Conf;
use Illuminate\Http\Request;
use DB;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seo  = $this->getSeoData();
        $data = [
            'pageinfo' => [],
            'seo'      => $seo,
            ];
        return view('admpanel::layouts.client.pages.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url = '/')
    {
        $seo  = $this->getSeoData();
        $data = [
            'sliders'  => Slider::where('is_active', '=', 0)->get(),
            'pageinfo' => [],
            'seo'      => $seo,
            'pages'    =>DB::table('menu')->where('url', '=', $url)
                            ->join('pages','pages.id','=','menu.page_id') 
                            ->select('pages.description') 
                            ->get(),
        ];
        return view('admpanel::layouts.client.pages.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/*
 * Создание массива метатегов
 */
    private function getSeoData($title = null, $description = null, $keywords = null, $img = [])
    {
        $seo = $this->getDefaultSeoData();
        if (!is_null($title)) {
            $seo['title'] = $seo['title'] . " - " . $title;
        }

        if (!is_null($description)) {
            $seo['description'] = $description;
        }

        if (!is_null($keywords)) {
            $seo['keywords'] = $keywords;
        }
        return $seo;
    }
/*
 * Значение мета тегов по умолчанию
 */
    private function getDefaultSeoData()
    {
        return [
            'description' => Conf::get('seo.default.seo_description'), //<VALUE>,
            'title'       => Conf::get('seo.default.seo_title'), //<VALUE>,
            'keywords'    => Conf::get('seo.default.seo_keywords'), //<VALUE>
            'img'         => [],
            'yandex_id'   => Conf::get('seo.counters.yandex_metrika', ''),
            'google_id'   => Conf::get('seo.counters.google_analytics', ''),
        ];

    }
}

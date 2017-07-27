<?php

namespace A4fteam\Admpanel\Src\Http\Controllers;

use A4fteam\Admpanel\Src\Http\Controllers\Controller;
use A4fteam\Admpanel\Src\Http\Models\PostTag;
use A4fteam\Admpanel\Src\Http\Models\Tags;
use Notifications;
use Title;

class TagsController extends Controller
{
    public function index()
    {
        Title::prepend('Теги');

        $data = [
            'title' => Title::renderr(' : ', true),
            'tags'  => Tags::i()->allWithPostsCount(),
        ];


        return view('admpanel::layouts.admin.tags.index', $data);
    }

    public function clearOrphaned()
    {
        $tags = Tags::i()->allWithPostsCount();
        foreach ($tags as $tag) {
            if ($tag->num == 0) {
                Tags::destroy($tag->id);
            }
        }
        Notifications::add('Empty tags removed', 'success');

        return redirect()->back();
    }

    public function remove($tag_id)
    {
        Tags::destroy($tag_id);
        PostTag::where(['tag_id' => $tag_id])->delete();

        Notifications::add('Tag removed', 'success');

        return redirect()->back();
    }
}

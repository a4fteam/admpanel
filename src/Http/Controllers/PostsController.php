<?php

namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Controllers\Controller;
use A4fteam\Admpanel\Http\Requests;
use A4fteam\Admpanel\Http\Models\ServiceCategory;
use A4fteam\Admpanel\Http\Models\Posts;
use A4fteam\Admpanel\Http\Models\PostTag;
use A4fteam\Admpanel\Http\Models\Tags;
use A4fteam\Admpanel\Http\Models\Page;
use Notifications;
use Pinger;
use Redirect;
use View;
use Title;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::with('category');

        if (request()->has('status')) {
            $posts->byStatus(request('status'));
        } else {
            $posts->whereNotIn('status', ['deleted', 'refused']);
        }

        Title::prepend('Статьи');

        $q = request()->get('q', null);

        if (!empty($q)) {
            Title::prepend('Search: ' . $q);
            $posts->search($q);
        }

        $data = [
            'pages' => Page::all(),
            'posts' => $posts->sort()->paginate(20),
            'url_params' => request()->except(['q']),
            'q' => $q,
            'status' => request('status', 'all'),
            'title' => Title::renderr(' : ', true),
            'categories' => ServiceCategory::all(),
        ];


        return view('admpanel::layouts.admin.posts.index', $data);
    }
    public function view($slug)
    {
        $post = Posts::i()->getBySlug($slug);
        view()->share('seo_title', $post->seo_title);
        view()->share('seo_description', $post->seo_description);
        view()->share('seo_keywords', $post->seo_keywords);

        Title::prepend($post->seo_title);

        try {
            if ($post->status == 'active') {
                $post->increment('views');
            }
        } catch (QueryException $e) {
            //This is just for demo purposes.
        }

        return view('admpanel::layouts.admin.posts.view', ['post' => $post]);
    }
    
    public function newPost()
    {
        Title::prepend('Новая статья');

        $data = [
            'pages' => Page::all(),
            'categories' => ServiceCategory::all(),
            'title'      => Title::renderr(' : ', true),
            'post'       => null,
            'save_url'   => route('root-posts-store'),
            'tags'       => Tags::all(),
        ];


        return view('admpanel::layouts.admin.posts.post', $data);
    }

    public function store(Requests\StorePostRequest $request, $post_id = null)
    {
        $post = Posts::findOrNew($post_id);

        if (empty($post)) {
            redirect()->back()->withInput();
        }

        $seo_title = ($request->get('seo_title', '') != '') ? $request->get('seo_title') : $request->get('title');

        if ($request->hasFile('img')) {
            $filename = $this->_uploadMiniature($request->file('img'));
            $post->img = $filename;
        }

        $post->user_id = auth()->user()->id;
        $post->category_id = $request->get('category_id');
        $post->page_id = $request->get('page_id');
        $post->title = $request->get('title');
        $post->excerpt = $request->get('excerpt');
        $post->content = $request->get('content');
        $post->seo_title = strip_tags($seo_title);
        $post->seo_description = strip_tags($request->get('seo_description'));
        $post->seo_keywords = mb_strtolower(strip_tags($request->get('seo_keywords')));
        $post->status = $request->get('status');
        $post->published_at = $request->get('published_at');
        if ($request->has('update_slug')) {
            $post->resluggify();
        }

        $post->save();

        $this->_setTags($request->get('tags'), $post->id);
        if ($request->has('ping')) {
            Pinger::pingAll($post->title, route('view', ['slug' => $post->slug]));
        }
        
        Notifications::add('Статья сохранена', 'success');
        return Redirect::route('root-post-edit', ['post_id' => $post->id]);
    }

    public function edit($post_id)
    {
        $post = Posts::with('tags')->find($post_id);

        Title::prepend('Редактирование статьи');
        Title::prepend($post->id);

        $data = [
            'pages' => Page::all(),
            'categories' => ServiceCategory::all(),
            'post'       => $post,
            'title'      => Title::renderr(' : ', true),
            'save_url'   => route('root-posts-store', ['post_id' => $post_id]),
            'tags'       => Tags::all(),
        ];


        return view('admpanel::layouts.admin.posts.post', $data);
    }

    public function pin($post_id)
    {
        $this->_setPinnedStatus($post_id, true);
        Notifications::add('Статья прикреплена', 'success');

        return Redirect::back();
    }

    public function unpin($post_id)
    {
        $this->_setPinnedStatus($post_id, false);
        Notifications::add('Статья откреплена', 'success');

        return Redirect::back();
    }

    public function toDraft($post_id)
    {
        $this->_setPostStatus($post_id, 'draft');
        Notifications::add('Статья отправлена в черновики', 'success');

        return Redirect::back();
    }

    public function toActive($post_id)
    {
        $this->_setPostStatus($post_id, 'active');
        Notifications::add('Статья опубликована', 'success');

        return Redirect::back();
    }

    public function toDeleted($post_id)
    {
        $this->_setPostStatus($post_id, 'deleted');
        Notifications::add('Статья удалена', 'success');

        return Redirect::back();
    }

    public function toCategory($post_id, $category_id)
    {
        $category = ServiceCategory::find($category_id);

        if (empty($category)) {
            Notifications::add('Category doesn\'t exist', 'danger');

            return Redirect::back();
        }

        $post = Posts::find($post_id);
        $post->category_id = $category_id;
        $post->save();

        Notifications::add('Post "'.str_limit($post->title, '35', '...').'" moved to category "'.e($category->title).'"', 'info');

        return Redirect::back();
    }

    private function _setPinnedStatus($post_id, $status)
    {
        $post = Posts::find($post_id);
        $post->is_pinned = $status;
        $post->save();

        return $post;
    }

    private function _setPostStatus($post_id, $status)
    {
        $post = Posts::find($post_id);
        $post->status = $status;
        $post->save();

        return $post;
    }

    private function _setTags($tags_str, $post_id)
    {
        PostTag::where('post_id', $post_id)->delete();

        $tags = explode(', ', $tags_str);

        foreach ($tags as $tag) {
            if (trim($tag) == '') {
                continue;
            }
            $tag = mb_strtolower($tag);
            $dbtag = Tags::where('tag', 'like', $tag)->first();
            if (empty($dbtag)) {
                $dbtag = new Tags();
                $dbtag->tag = strip_tags($tag);
                $dbtag->save();
            }
            $post_tag = new PostTag();

            $post_tag->post_id = $post_id;
            $post_tag->tag_id = $dbtag->id;
            $post_tag->save();
        }
    }

    private function _uploadMiniature($file)
    {
        $path = public_path('upload');
        $filename = generate_filename($path, $file->getClientOriginalExtension());
        $file->move($path, $filename);

        return $filename;
    }
}

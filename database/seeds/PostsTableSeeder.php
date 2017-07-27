<?php

use Illuminate\Database\Seeder;
use A4f\Admpanel\Src\Http\Models\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $post = $this->findPost('lorem-ipsum-post');
        if (!$post->exists) {
            $post->fill([
                'title'            => 'Lorem Ipsum Post',
                'category_id'        => 1,
                'user_id'        => 0,
                'page_id'        => 1,
                'excerpt'          => 'This is the excerpt for the Lorem Ipsum Post',
                'content'             => '<p>This is the body of the lorem ipsum post</p>',
                'img'            => 'FZtMfaE2ZC.jpg',
                'slug'             => 'lorem-ipsum-post',
                'seo_title' => 'This is the meta description',
                'seo_keywords' => 'This is the meta description',
                'seo_description'    => 'keyword1, keyword2, keyword3',
                'status'           => 'active',
                'published_at'           => '25.07.2017',
                	
            ])->save();
        }

        $post = $this->findPost('my-sample-post');
        if (!$post->exists) {
            $post->fill([
                'title'     => 'My Sample Post',
                'category_id'        => 1,
                'user_id'        => 0,
                'page_id'        => 1,
                'excerpt'   => 'This is the excerpt for the sample Post',
                'content'      => '<p>This is the body for the sample post, which includes the body.</p>
                <h2>We can use all kinds of format!</h2>
                <p>And include a bunch of other stuff.</p>',
                'img'            => 'RVPqjDkzfV.jpg',
                'slug'             => 'my-sample-post',
                'seo_title' => 'Meta Description for sample post',
                'seo_keywords' => 'Meta Description for sample post',
                'seo_description'    => 'keyword1, keyword2, keyword3',
                'status'           => 'active',
                'published_at'           => '25.07.2017',
            ])->save();
        }
    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findPost($slug)
    {
        return Posts::firstOrNew(['slug' => $slug]);
    }
}

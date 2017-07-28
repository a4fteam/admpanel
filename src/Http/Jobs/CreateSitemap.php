<?php

namespace A4fteam\Admpanel\Http\Jobs;

use A4fteam\Admpanel\Http\Models\Posts;
use Conf;
//use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

//class CreateSitemap extends Job implements SelfHandling, ShouldQueue
class CreateSitemap extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $posts = Posts::active()->get();
        $fh = fopen(public_path(Conf::get('sitemap.filename', 'sitemap.xml', false)), 'w');
        fwrite($fh, view('admpanel::files.sitemap', compact('posts'))->render());
        fclose($fh);
    }
}

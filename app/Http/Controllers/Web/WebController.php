<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests;
use App\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseWebController;

class WebController extends BaseWebController
{
    protected $post;

    public function __construct(Post $post)
    {
        parent::__construct();

        if (app('App\Models\Webs\Web')->subdomain === 'admin' && ! app('App\Models\Webs\Web')->getConfig('web')) {
            abort(404);
        }

        $this->post = $post;
    }

    public function index(Request $request)
    {
        $last_posts = $this->post
            ->where('status', 'published')
            ->where('published_at', '<', date('Y-m-d H:i:s'))
            ->with(['author', 'category'])
            ->orderBy('fixed', 1)
            ->orderBy('published_at', 'DESC')
            ->paginate($this->web->getConfig('posts.pagination'));

        return view('index', compact('last_posts'));
    }

    public function custom_css(Request $request)
    {
        return response()
            ->view('customcss')
            ->header('Content-Type', 'text/css');
    }
}

<?php

namespace App\Http\Controllers\Web\Posts;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseWebController;

class PostsController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(Request $request, $id)
    {
        $post = $this->web->posts()
            ->where('status', 'published')
            ->with('author', 'category')
            ->findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function author(Request $request, $id)
    {
        $user = $this->web->users()
            ->with('posts.translations')
            ->findOrFail($id);

        $posts = $user->posts()
            ->paginate(10);

        return view('posts.author', compact('user', 'posts'));
    }

    public function category(Request $request, $id)
    {
        $category = $this->web->categories()
            ->with('translations', 'posts.translations')
            ->findOrFail($id);
            
        $posts = $category->posts()
            ->paginate(10);

        return view('posts.category', compact('category', 'posts'));
    }
}

<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseWebController;

class PagesController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(Request $request, $id)
    {
        $page = $this->web->pages()->where('status', 'published')->with('author')->findOrFail($id);

        return view('pages.show', compact('page'));
    }
}

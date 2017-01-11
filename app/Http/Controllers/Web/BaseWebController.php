<?php

namespace App\Http\Controllers\Web;

use Auth;
use Theme;
use Request;
use App\Http\Controllers\Controller;

class BaseWebController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        Theme::set($this->web->getConfig('theme'));

        view()->share('web', $this->web);
        view()->share('widgets_left', $this->web->widgets()->active()->with(['links' => function ($query) {
            $query->orderBy('order', 'ASC');
        }])->whereSide('left')->orderBy('order')->get());
        view()->share('widgets_right', $this->web->widgets()->active()->with(['links' => function ($query) {
            $query->orderBy('order', 'ASC');
        }])->whereSide('right')->orderBy('order')->get());
    }
}

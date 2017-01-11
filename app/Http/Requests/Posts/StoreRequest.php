<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            config('app.locale') . '.title' => 'required',
            config('app.locale') . '.slug' => 'required|alpha_dash',
            config('app.locale') . '.text' => 'required',
            config('app.locale') . '.user_id' => 'required|exists:users,id',
            'form_id' => 'exists:forms,id',
            'category_id' => 'required|exists:posts_categories,id',
            'status' => 'required|in:' . implode(',', config('protecms.posts.status')),
            'comments_status' => 'required|in:' . implode(',', config('protecms.posts.comments_status')),
        ];
    }
}

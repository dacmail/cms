<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $this->get('langform') . '.title' => 'required',
            $this->get('langform') . '.slug' => 'required|alpha_dash',
            $this->get('langform') . '.text' => 'required',
            $this->get('langform') . '.user_id' => 'required|exists:users,id',
            'form_id' => 'exists:forms,id',
            'status' => 'required|in:' . implode(',', config('protecms.posts.status')),
        ];
    }
}

<?php

namespace App\Http\Requests\Widgets;

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
            $this->get('langform') . '.content' => 'required_if:type,custom',
            'side' => 'required|in:' . implode(',', config('protecms.widgets.side')),
            'status' => 'required|in:' . implode(',', config('protecms.widgets.status')),
            'type' => 'required|in:' . implode(',', config('protecms.widgets.type')),
        ];
    }
}

<?php

namespace App\Http\Requests\Design;

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
            'color' => 'required',
            'logo' => 'string',
            'header' => 'string'
        ];
    }
}

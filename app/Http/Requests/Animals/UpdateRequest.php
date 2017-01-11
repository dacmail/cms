<?php

namespace App\Http\Requests\Animals;

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
            'name' => 'required',
            'old_name' => '',
            'status' => 'required',
            'kind' => 'required',
            'location' => 'required',
            'gender' => 'required',
            'visible' => '',
            'microchip' => '',
            'birth_date' => '',
            'birth_date_approximate' => '',
            'entry_date' => '',
            'entry_date_approximate' => '',
            'weight' => '',
            'height' => '',
        ];
    }
}

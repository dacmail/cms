<?php

namespace App\Http\Requests\Calendar;

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
            'title' => 'required',
            'all_day' => 'required|boolean',
            'type' => 'required|in:' . implode(',', config('protecms.calendar.type')),
            'description' => 'string',
        ];
    }
}

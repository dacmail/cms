<?php

namespace App\Http\Requests\Partners;

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
            'name' => 'required',
            'email' => 'email',
            'donation' => 'required|numeric',
            'start_date' => 'date',
            'end_date' => 'date',
            'donation_time' => 'required|in:' . implode(',', config('protecms.partners.donation_time')),
            'text' => ''
        ];
    }
}

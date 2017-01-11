<?php

namespace App\Http\Requests\Animals\Sponsorships;

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
            'status' => 'required|in:' . implode(',', config('protecms.animals.sponsorships.status')),
            'visible' => 'required|in:' . implode(',', config('protecms.animals.sponsorships.visible')),
            'donation_time' => 'required|in:' . implode(',', config('protecms.animals.sponsorships.donation_time')),
            'payment_method' => 'in:' . implode(',', config('protecms.animals.sponsorships.payment_method')),
            'start_date' => '',
            'end_date' => '',
            'donation' => '',
            'text' => '',
        ];
    }
}

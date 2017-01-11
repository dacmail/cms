<?php

namespace App\Http\Requests\Finances;

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
            'description' => '',
            'amount' => 'required|numeric',
            'executed_at' => 'required',
            'type' => 'required|in:' . implode(',', config('protecms.finances.type')),
            'reason' => 'required|in:' . implode(',', config('protecms.finances.reason'))
        ];
    }
}

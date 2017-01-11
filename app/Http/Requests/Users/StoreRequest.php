<?php

namespace App\Http\Requests\Users;

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
            'email' => 'required|unique:users',
            'password' => 'required|between:5,30',
            'password_confirmation' => 'required|same:password',
            'status' => 'required|in:' . implode(',', config('protecms.users.status')),
            'type' => 'required|in:' . implode(',', config('protecms.users.type')),
            'notification' => 'required|in:yes,not'
        ];
    }
}

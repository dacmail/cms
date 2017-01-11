<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\Location\City;

class LocationController extends Controller
{
    public function states(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        return $country->states()->select('id', 'country_id', 'name')->get();
    }

    public function cities(Request $request, $id)
    {
        $state = State::findOrFail($id);

        return $state->cities()->select('id', 'state_id', 'name')->get();
    }
}

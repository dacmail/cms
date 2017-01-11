<?php

namespace App\Models\Animals;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\Location\City;

class TemporaryHome extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'temporary_homes';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city_id', 'state_id', 'country_id', 'status',
        'text'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

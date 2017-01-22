<?php

namespace App\Models\Animals;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\Location\City;

class Sponsorship extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'animals_sponsorships';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'start_date', 'end_date', 'donation', 'donation_time', 'payment_method', 'address', 'city_id',
        'state_id', 'country_id', 'status', 'text', 'visible'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['animal'];

    protected $dates = [
       'start_date', 'end_date'
    ];

    /**
     * Set attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, ['start_date', 'end_date'])) {
            if ($value !== '') {
                $value = date('Y-m-d', strtotime($value));
            } else {
                $value = null;
            }
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Relations
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
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

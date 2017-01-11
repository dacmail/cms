<?php

namespace App\Models\Partners;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'partners';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'web_id', 'name', 'email', 'donation', 'donation_time', 'payment_method', 'city', 'start_date', 'end_date', 'text',
        'phone', 'address', 'city_id', 'state_id', 'country_id'
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'start_date', 'end_date'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

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
            if ($value != '') {
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
    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}

<?php

namespace App\Models\Animals;

use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Health extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'animals_health';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'animal_id', 'type', 'title', 'medicine', 'text', 'finish_text', 'start_date', 'end_date', 'cost', 'treatments_number',
        'treatments_each', 'treatments_time', 'treatments_life', 'test_result', 'hidden_in_calendar'
    ];

    protected $dates = [
        'start_date', 'end_date'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['animal'];

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
                $value = date('Y-m-d H:i:s', strtotime($value));
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
}

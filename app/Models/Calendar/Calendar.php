<?php

namespace App\Models\Calendar;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'calendar';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'all_day', 'type'
    ];

    protected $appends = ['color'];

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
            if ($value !== '') {
                $value = date('Y-m-d H:i:s', strtotime($value));
            } else {
                $value = null;
            }
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Get color by type
     * 
     * @return string
     */
    public function getColorAttribute()
    {
        switch ($this->type) {
            case 'transport':
                return '#F44336';
                break;

            case 'vaccine':
                return '#C2185B';
                break;

            case 'revision':
                return '#9C27B0';
                break;

            case 'treatment':
                return '#2196F3';
                break;

            case 'work':
                return '#4CAF50';
                break;

            case 'visit':
                return '#FF9800';
                break;

            case 'other':
                return '#00BCD4';
                break;

            default:
                return '#2196F3';
                break;
        }
    }

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}

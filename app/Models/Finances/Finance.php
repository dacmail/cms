<?php

namespace App\Models\Finances;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'finances';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'amount', 'type', 'reason', 'executed_at'
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'executed_at'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    /**
     * @return bool
     */
    public function isIncome()
    {
        return $this->type === 'income';
    }

    /**
     * @return bool
     */
    public function isSpending()
    {
        return $this->type === 'spending';
    }

    /**
     * Set attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, ['executed_at'])) {
            $value = date('Y-m-d H:i:s', strtotime($value));
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

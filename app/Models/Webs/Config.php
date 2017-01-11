<?php

namespace App\Models\Webs;

use App\Models\BaseModel;
use App\Models\Users\User;

class Config extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'webs_config';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'web_id', 'key', 'value'
    ];

    public function getValueAttribute($value)
    {
        if ($value instanceof \Traversable) {
            return (array) $value;
        }

        return $value;
    }

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}

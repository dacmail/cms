<?php

namespace App\Models\Widgets;

use App\Models\BaseModel;

class WidgetTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'widgets_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'content'
    ];
}

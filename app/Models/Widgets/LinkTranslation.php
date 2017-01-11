<?php

namespace App\Models\Widgets;

use App\Models\BaseModel;

class LinkTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'widgets_links_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'link'
    ];
}

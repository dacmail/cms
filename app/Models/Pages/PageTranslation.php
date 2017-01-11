<?php

namespace App\Models\Pages;

use App\Models\BaseModel;

class PageTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'pages_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'slug', 'text', 'user_id'
    ];
}

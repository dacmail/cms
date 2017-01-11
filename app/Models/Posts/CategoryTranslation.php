<?php

namespace App\Models\Posts;

use App\Models\BaseModel;

class CategoryTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts_categories_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'slug', 'text'
    ];
}

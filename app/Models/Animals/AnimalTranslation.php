<?php

namespace App\Models\Animals;

use App\Models\BaseModel;

class AnimalTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'animals_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'text', 'private_text', 'health_text', 'breed'
    ];
}

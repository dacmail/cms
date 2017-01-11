<?php

namespace App\Models\Forms;

use App\Models\BaseModel;

class FieldTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'forms_fields_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title'
    ];
}

<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Model;

class FormTranslation extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'forms_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'slug', 'text', 'subject', 'user_id'
    ];
}

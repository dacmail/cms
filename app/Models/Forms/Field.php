<?php

namespace App\Models\Forms;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use Dimsav\Translatable\Translatable;

class Field extends BaseModel
{
    use Translatable;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'forms_fields';

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title'
    ];

    /**
     * Insert relations
     *
     * @var array
     */
    protected $with = [
        'translations'
    ];

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'name', 'type', 'required'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['form'];

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

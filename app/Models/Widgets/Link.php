<?php

namespace App\Models\Widgets;

use App\Models\BaseModel;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends BaseModel
{
    use SoftDeletes, Translatable;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'widgets_links';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'widget_id', 'type', 'order'
    ];

    /**
     * With relation
     *
     * @var array
     */
    protected $with = [
        'translations'
    ];

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title', 'link'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['widget'];

    /**
     * Relations
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}

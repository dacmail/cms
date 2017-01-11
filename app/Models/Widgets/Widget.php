<?php

namespace App\Models\Widgets;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends BaseModel
{
    use SoftDeletes, Translatable, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'widgets';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'file', 'status', 'side', 'order', 'type', 'config'
    ];

    /**
     * With relation
     *
     * @var array
     */
    protected $with = [
        'translations', 'links.translations'
    ];

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title', 'content'
    ];

    protected $casts = [
        'config' => 'array'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    public function getConfig($config)
    {
        if (isset($this->config[$config])) {
            return $this->config[$config];
        }

        return null;
    }

    /**
     * @param $request
     */
    public function setConfigAttribute($request)
    {
        if ($request !== '0') {
            $config = $this->config;
            foreach ($request as $key => $value) {
                if ((bool) $value) {
                    $config[$key] = $value;
                } else {
                    unset($config[$key]);
                }
            }

            $this->attributes['config'] = json_encode($config);
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}

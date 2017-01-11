<?php

namespace App\Models\Pages;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Models\Users\User;
use App\Models\Forms\Form;
use App\Helpers\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    use SoftDeletes, Translatable, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title', 'slug', 'text', 'user_id'
    ];

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'status', 'published_at', 'category_id', 'form_id'
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    /**
     * Set attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, ['published_at'])) {
            $value = date('Y-m-d H:i:s', strtotime($value));
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

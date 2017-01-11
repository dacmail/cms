<?php

namespace App\Models\Posts;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Models\Users\User;
use App\Models\Forms\Form;
use App\Helpers\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use LogsActivity, SoftDeletes, Translatable;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Translatable fields
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'slug', 'text', 'user_id'
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
        'id', 'status', 'comments_status', 'comments', 'published_at', 'category_id', 'form_id', 'fixed'
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

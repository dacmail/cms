<?php

namespace App\Models\Posts;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use SoftDeletes, Translatable;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts_categories';

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title', 'slug', 'text'
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

    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

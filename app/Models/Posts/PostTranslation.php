<?php

namespace App\Models\Posts;

use App\Models\BaseModel;
use App\Models\Users\User;

class PostTranslation extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts_translations';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'title', 'slug', 'text', 'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

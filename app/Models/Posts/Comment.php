<?php

namespace App\Models\Posts;

use App\Models\BaseModel;
use App\Models\Users\User;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts_comments';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * Relations
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}

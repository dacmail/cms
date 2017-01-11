<?php

namespace App\Models\Files;

use App\Models\Webs\Web;
use App\Models\BaseModel;
use App\Models\Users\User;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'web_id', 'user_id', 'title', 'description', 'file', 'extension', 'public'
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

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

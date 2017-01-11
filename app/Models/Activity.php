<?php

namespace App\Models;

use App\Models\Users\User;
use App\Models\Webs\Web;
use Illuminate\Database\Eloquent\Model;

class Activity extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'web_id', 'log', 'description', 'model_id', 'model_type', 'user_id', 'user_type'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model_id = $model->id;
        $this->model_type = get_class($model);

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setWeb(Web $web)
    {
        $this->web_id = isset($web->id) ? $web->id : null;

        return $this;
    }

    public function setUser($auth)
    {
        $this->user_id = isset($auth->id) ? $auth->id : null;

        return $this;
    }
}

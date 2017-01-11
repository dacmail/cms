<?php

namespace App\Models;

use App\Helpers\Traits\FilterByWeb;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use FilterByWeb;

    /**
     * Set attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return Model
     */
    public function setAttribute($key, $value)
    {
        if ($value === '') {
            $value = null;
        }

        return parent::setAttribute($key, $value);
    }
}

<?php

namespace App\Models\Location;

use App\Models\Webs\Web;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'state_id', 'name'
    ];

    /**
     * Relations
     */
    public function webs()
    {
        return $this->hasMany(Web::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

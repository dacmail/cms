<?php

namespace App\Models\Location;

use App\Models\Webs\Web;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'iso', 'name',
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

    public function states()
    {
        return $this->hasMany(State::class);
    }
}

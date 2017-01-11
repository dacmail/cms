<?php

namespace App\Models\Location;

use App\Models\Webs\Web;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'name'
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}

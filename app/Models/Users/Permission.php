<?php

namespace App\Models\Users;

use App\Models\BaseModel;

class Permission extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'permission'
    ];

    /**
     * Hidden fields
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * Relations
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

trait FilterByWeb
{
    protected static $excludedTables = [
        'webs_config', 'users'
    ];

    /**
     * @return string
     */
    public static function getTableName() : string
    {
        return with(new static)->getTable();
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        if (Schema::hasColumn(self::getTableName(), 'web_id')
            && ! in_array(self::getTableName(), self::$excludedTables)) {

            if (! app()->runningInConsole()) {
                static::creating(function ($model) {
                    $model->web_id = app('App\Models\Webs\Web')->id;
                });
            }


            static::addGlobalScope('web', function (Builder $builder) {
                if (app('App\Models\Webs\Web')->subdomain === 'admin' && app('App\Models\Webs\Web')->getConfig('web')) {
                    $builder->where('web_id', app('App\Models\Webs\Web')->getConfig('web'));
                } elseif (app('App\Models\Webs\Web')->subdomain !== 'admin') {
                    $builder->where('web_id', app('App\Models\Webs\Web')->id);
                }
            });
        }
    }
}

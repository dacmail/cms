<?php

namespace App\Helpers\Traits;

trait FilterBy
{
    public function filterBy($collection, $request, $fields)
    {
        $relations = [];
        foreach ($fields as $field) {
            // Is a translation
            if (strstr($field, '.')) {
                $relation = strstr($field, '.', true);
                $relation_field = str_replace('.', '', strstr($field, '.'));
                $relations[$relation] = function ($query) use ($relation_field, $request, $field) {
                    $query->where($relation_field, 'LIKE', '%'. $request->get(str_replace('.', '_', $field)) . '%');
                };

                if ($relation == 'translations') {
                    $collection = $collection->whereHas('translations', function ($query) use ($request, $relation_field, $field) {
                        $query->where('locale', config('app.locale'))
                            ->where($relation_field, 'LIKE', '%'. $request->get(str_replace('.', '_', $field)) .'%');
                    });
                }
            } elseif (empty($request->get($field))) {
                continue;
            // Is a date
            } elseif (strstr($field, '_date') || strstr($field, '_at') || $field == 'last_login') {
                if (strstr($request->get($field), '-')) {
                    $from = date('Y-m-d', strtotime(str_replace('/', '-', str_replace(' - ', '', strstr($request->get($field), ' - ')))));
                    $to = date('Y-m-d', strtotime(str_replace('/', '-', strstr($request->get($field), ' - ', true))));

                    $collection = $collection->where($field, '<=', $from)
                        ->where($field, '>=', $to);
                } else {
                    $date = date('Y-m-d', strtotime($request->get($field)));
                    $collection = $collection->where($field, '=', $date);
                }
            } else {
                if (strstr($request->get($field), ',')) {
                    $collection = $collection->whereIn($field, explode(',', $request->get($field)));
                } else {
                    if ($field === 'gender') {
                        $collection = $collection->where($field, '=', $request->get($field));
                    } else {
                        $collection = $collection->where($field, 'LIKE', '%' . $request->get($field) . '%');
                    }
                }
            }
        }

        if (count($relations)) {
            $collection = $collection->with($relations);
        }

        if ($request->has('sort')) {
            if (strstr($request->get('sort'), '-')) {
                $collection = $collection->orderBy(str_replace('-', '', $request->get('sort')), 'DESC');
            } else {
                $collection = $collection->orderBy($request->get('sort'));
            }
        }

        return $collection;
    }
}

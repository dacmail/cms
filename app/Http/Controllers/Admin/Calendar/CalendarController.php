<?php

namespace App\Http\Controllers\Admin\Calendar;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Models\Calendar\Calendar;
use App\Http\Requests\Calendar\StoreRequest;
use App\Http\Requests\Calendar\UpdateRequest;
use App\Http\Controllers\Admin\BaseAdminController;

class CalendarController extends BaseAdminController
{
    /**
     * @var Calendar
     */
    protected $calendar;

    /**
     * @var Animal
     */
    protected $animal;

    /**
     * CalendarController constructor.
     * @param Calendar $calendar
     * @param Animal $animal
     */
    public function __construct(Calendar $calendar, Animal $animal)
    {
        parent::__construct();

        $this->calendar = $calendar;
        $this->animal = $animal;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Calendar::class);

        return view('admin.calendar.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Calendar::class);

        return view('admin.calendar.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Calendar::class);

        $this->calendar
            ->create($request->all());

        flash('El evento se ha creado correctamente.');

        return redirect()->to(route('admin::calendar::index') . '?type=all');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('update', $event);

        $event = $this->calendar
            ->findOrFail($id);

        return view('admin.calendar.edit', compact('event'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $event = $this->calendar
            ->findOrFail($id);

        $this->authorize('update', $event);

        $event->update($request->all());

        flash('El evento se ha actualizado correctamente.');

        return redirect()->to(route('admin::calendar::edit', ['id' => $id]) . '?type=all');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $event = $this->calendar
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $event);

        $event->delete();

        flash('El evento se ha eliminado correctamente.');

        return redirect()->to(route('admin::calendar::index') . '?type=all');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function calendar(Request $request)
    {
        $this->authorize('view', Calendar::class);

        $events = $this->calendar;

        if ($request->has('type')) {
            if ($request->get('type') !== 'all') {
                $events = $events->where('type', $request->get('type'));
            }
        }

        $calendar = [];

        if ($request->get('type') == 'health' || $request->get('type') == 'all') {
            $animals = $this->animal->with('health')->get();

            foreach ($animals as $animal) {
                foreach ($animal->health()->where('hidden_in_calendar', 0)->get() as $health) {
                    if ($health->type == 'treatment') {
                        switch ($health->treatments_time) {
                            case 'hour':
                                $hours = 1;
                                break;

                            case 'day':
                                $hours = 24;
                                break;

                            case 'week':
                                $hours = 168;
                                break;

                            case 'month':
                                $hours = 730.001;
                                break;

                            case 'year':
                                $hours = 8760;
                                break;
                        }

                        $treatments_each = $health->treatments_each * $hours;
                        if ($treatments_each < 24) {
                            $treatments_each = 24;
                        }

                        if ($health->treatments_life) {
                            $end_date = Carbon::now()->addMonths(12);
                            $date_while = $health->start_date;

                            if ($treatments_each > 0) {
                                while ($date_while->format('Y-m-d H:i:s') < $end_date->format('Y-m-d H:i:s')) {
                                    $calendar[] = [
                                        'id' => $health->id,
                                        'title' => $health->title . ' (' . $animal->name . ')',
                                        'description' => $health->text,
                                        'allDay' => $health->treatments_life ? true : false,
                                        'start' => $date_while->format('Y-m-d H:i:s'),
                                        'end' => $date_while->format('Y-m-d H:i:s'),
                                        'type' => trans('animals.health.type.' . $health->type),
                                        'color' => $health->color,
                                        'event_url' => route('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id]),
                                        'edit_url' => null,
                                        'delete_url' => null,
                                        'treatment' => [
                                            'cost' => $health->cost ?: '-',
                                            'medicine' => $health->medicine ?: '-',
                                            'number' => $health->treatments_number ?: '-',
                                            'each' => $health->treatments_each ?: '-',
                                            'time' => trans('animals.health.treatments.time.' . $health->treatments_time)
                                        ]
                                    ];

                                    $date_while = $date_while->addHours($treatments_each);
                                }
                            } else {
                                $calendar[] = [
                                    'id' => $health->id,
                                    'title' => $health->title . ' (' . $animal->name . ')',
                                    'description' => $health->text,
                                    'allDay' => $health->treatments_life ? true : false,
                                    'start' => $date_while->format('Y-m-d H:i:s'),
                                    'end' => $date_while->format('Y-m-d H:i:s'),
                                    'type' => trans('animals.health.type.' . $health->type),
                                    'color' => $health->color,
                                    'event_url' => route('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id]),
                                    'edit_url' => null,
                                    'delete_url' => null,
                                    'treatment' => [
                                        'cost' => $health->cost ?: '-',
                                        'number' => $health->treatments_number ?: '-',
                                        'each' => $health->treatments_each ?: '-',
                                        'time' => trans('animals.health.treatments.time.' . $health->treatments_time)
                                    ]
                                ];
                            }

                            continue;
                        } elseif (! $health->end_date) {
                            $end_date = $health->start_date ? $health->start_date->format('Y-m-d H:i:s') : null;
                        } else {
                            $end_date = $health->end_date ? $health->end_date->format('Y-m-d H:i:s') : null;
                        }

                        if (is_int($health->treatments_number) && $health->treatments_number > 0 && $treatments_each > 0) {
                            $start_date = $health->start_date;
                            $end_date = $health->start_date;

                            if ($treatments_each == 24 && $health->treatments_time == 'hour') {
                                $treatments_each = $health->treatments_each;
                            }

                            for ($i = 1; $i <= $health->treatments_number; $i++) {
                                $calendar[] = [
                                    'id' => $health->id,
                                    'title' => $health->title . ' (' . $animal->name . ')',
                                    'description' => $health->text,
                                    'allDay' => $health->treatments_life ? true : false,
                                    'start' => $start_date->format('Y-m-d H:i:s'),
                                    'end' => $end_date->format('Y-m-d H:i:s'),
                                    'type' => trans('animals.health.type.' . $health->type),
                                    'color' => $health->color,
                                    'event_url' => route('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id]),
                                    'edit_url' => null,
                                    'delete_url' => null,
                                ];

                                $start_date->addHours($treatments_each);
                                $end_date->addHours($treatments_each);
                            }
                        } else {
                            $calendar[] = [
                                'id' => $health->id,
                                'title' => $health->title . ' (' . $animal->name . ')',
                                'description' => $health->text,
                                'allDay' => $health->treatments_life ? true : false,
                                'start' => $health->start_date ? $health->start_date->format('Y-m-d H:i:s') : null,
                                'end' => $end_date,
                                'type' => trans('animals.health.type.' . $health->type),
                                'color' => $health->color,
                                'event_url' => route('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id]),
                                'edit_url' => null,
                                'delete_url' => null,
                            ];
                        }
                    } else {
                        $calendar[] = [
                            'id' => $health->id,
                            'title' => $health->title . ' (' . $animal->name . ')',
                            'description' => $health->text,
                            'allDay' => $health->treatments_life ? true : false,
                            'start' => $health->start_date ? $health->start_date->format('Y-m-d H:i:s') : null,
                            'end' => $health->end_date ? $health->end_date->format('Y-m-d H:i:s') : null,
                            'type' => trans('animals.health.type.' . $health->type),
                            'color' => $health->color,
                            'event_url' => route('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id]),
                            'edit_url' => null,
                            'delete_url' => null,
                        ];
                    }
                }
            }
        }

        $events = $events->select(\DB::raw(
            'id, title, description, all_day as allDay, start_date as start, end_date as end, type, url'
        ))->get();

        foreach ($events as $event) {
            $calendar[] = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'allDay' => $event->allDay,
                'start' => $event->start,
                'end' => $event->end,
                'type' => trans('calendar.type.' . $event->type),
                'color' => $event->color,
                'event_url' => $event->url,
                'edit_url' => route('admin::calendar::edit', ['id' => $event->id]),
                'delete_url' => route('admin::calendar::delete', ['id' => $event->id]),
            ];
        }

        return $calendar;
    }

    /**
     * @return array
     */
    public function getSidebar()
    {
        return [
            [
                'title' => 'Calendario',
                'menu' => [
                    'title' => 'Calendario',
                    'icon' => 'fa fa-calendar',
                    'url' => 'javascript:;',
                    'base' => 'admin/calendar*',
                    'submenu' => [
                        [
                            'title' => 'Completo',
                            'icon' => 'fa fa-calendar',
                            'url' => route('admin::calendar::index') . '?type=all'
                        ],
                        [
                            'title' => 'Vacunas',
                            'icon' => 'fa fa-medkit',
                            'url' => route('admin::calendar::index') . '?type=vaccine'
                        ],
                        [
                            'title' => 'Tratamientos',
                            'icon' => 'fa fa-stethoscope',
                            'url' => route('admin::calendar::index') . '?type=treatment'
                        ],
                        [
                            'title' => 'Revisiones',
                            'icon' => 'fa fa-eye',
                            'url' => route('admin::calendar::index') . '?type=revision'
                        ],
                        [
                            'title' => 'Tareas',
                            'icon' => 'fa fa-tasks',
                            'url' => route('admin::calendar::index') . '?type=work'
                        ],
                        [
                            'title' => 'Transporte',
                            'icon' => 'fa fa-truck',
                            'url' => route('admin::calendar::index') . '?type=transport'
                        ],
                        [
                            'title' => 'Visitas',
                            'icon' => 'fa fa-users',
                            'url' => route('admin::calendar::index') . '?type=visit'
                        ],
                        [
                            'title' => 'Otros',
                            'icon' => 'fa fa-list-ul',
                            'url' => route('admin::calendar::index') . '?type=other'
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Acciones',
                'permissions' => ['admin.calendar'],
                'menu' => [
                    'title' => 'Acciones',
                    'icon' => 'fa fa-calendar-plus-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/calendar*',
                    'submenu' => [
                        [
                            'title' => 'Crear evento',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::calendar::create'),
                            'permissions' => ['admin.calendar']
                        ],
                    ]
                ]
            ]
        ];
    }
}

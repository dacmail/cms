<?php

namespace App\Http\Controllers\Web\Animals;

use Mail;
use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Http\Controllers\Web\BaseWebController;

class AnimalsController extends BaseWebController
{
    use FilterBy;

    /**
     * AnimalsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request = $this->translateFilters($request);

        $total = $this->web->animals()->where('visible', 'visible')->count();
        $animals = $this->filterBy($this->web->animals()
            ->where('visible', 'visible')
            ->with(['photos' => function ($query) {
                $query->orderBy('main', 'DESC');
            }]), $request, ['name', 'status', 'kind', 'gender', 'location', 'birth_date'])
            ->orderBy('name', 'ASC')
            ->paginate();

        return view('animals.index', compact('animals', 'total'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $animal = $this->web->animals()
            ->where('visible', 'visible')
            ->with(['translations', 'public_sponsorships', 'photos' => function ($query) {
                $query->main();
            }])->findOrFail($id);

        return view('animals.show', compact('animal'));
    }

    public function contact(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $animal = $this->web->animals()
            ->where('id', '=', $id)
            ->firstOrFail();

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
            'link' => route('web::animals::show', ['id' => $animal->id])
        ];

        Mail::send('emails.web.animal', [
            'data' => $data,
            'animal' => $animal
        ], function ($m) use ($animal, $data) {
            $m->to($this->web->getConfig('animals.contact_email'))
                ->from($data['email'])
                ->subject($data['subject']);
        });

        flash('Mensaje enviado correctamente.');

        return redirect()->route('web::animals::show', ['id' => $animal->id]);
    }

    /*
     * Temporal
     */
    private function translateFilters($request)
    {
        $filters = [
            'estado' => 'status',
            'especie' => 'kind',
            'genero' => 'gender',
            'localizacion' => 'location'
        ];

        foreach ($request->all() as $key => $value) {
            if (isset($filters[$key])) {
                foreach (explode(',', $value) as $v) {
                    foreach (config('protecms.animals.'.$filters[$key]) as $filter) {
                        if ($v == str_slug(trans_choice('animals.'.$filters[$key].'.' . $filter, 2))) {
                            $value = str_replace($v, $filter, $value);
                        }
                    }
                }

                $request->merge([
                    $filters[$key] => $value
                ]);
            }
        }

        return $request;
    }
}

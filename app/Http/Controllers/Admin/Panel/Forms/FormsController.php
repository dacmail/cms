<?php

namespace App\Http\Controllers\Admin\Panel\Forms;

use App\Models\Forms\Form;
use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Forms\StoreRequest;
use App\Http\Requests\Forms\UpdateRequest;

class FormsController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Form
     */
    protected $form;

    /**
     * FormsController constructor.
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        parent::__construct();

        $this->form = $form;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Form::class);

        $total = $this->form->count();
        $forms = $this->filterBy($this->form, $request, ['translations.title', 'email', 'status'])
            ->with(['author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PAGINATION);

        return view('admin.panel.forms.index', compact('forms', 'request', 'total'));
    }

    public function deleted(Request $request)
    {
        $this->authorize('view', Form::class);

        $total = $this->form->onlyTrashed()->count();
        $forms = $this->filterBy($this->form->onlyTrashed(), $request, ['translations.title', 'email', 'status'])
            ->with(['author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PAGINATION);

        return view('admin.panel.forms.deleted', compact('forms', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Form::class);

        return view('admin.panel.forms.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Form::class);

        if (! count($request->get('fields'))) {
            return redirect()->back()->withErrors([
                'fields' => 'El formulario debe contener campos'
            ])->withInput();
        }

        $form = $this->form
            ->create($request->all());

        foreach ($request->get('fields') as $i => $field) {
            $i++;
            $form->fields()->create([
                'order' => $i,
                'name' => $i,
                'type' => $field['type'],
                'required' => $field['required'],
                $request->get('langform') => [
                    'title' => $field['title']
                ]
            ]);
        }

        flash('El formulario se ha creado correctamente.');

        return redirect()->route('admin::panel::forms::edit', ['id' => $form->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param Request $request
     */
    public function edit($id)
    {
        $form = $this->form
            ->with(['author', 'fields'])
            ->findOrFail($id);

        $this->authorize('update', $form);

        return view('admin.panel.forms.edit', compact('form'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        if (! count($request->get('fields'))) {
            return redirect()->back()->withErrors([
                'fields' => 'El formulario debe contener campos'
            ])->withInput();
        }

        $form = $this->form->findOrFail($id);

        $this->authorize('update', $form);

        $fields = [];
        foreach ($request->get('fields') as $field) {
            if (isset($field['id'])) {
                $fields[] = (int) $field['id'];
            }
        }

        if ($form->hasTranslation($request->get('langform'))) {
            foreach ($form->fields as $field) {
                $field->deleteTranslations($request->get('langform'));
            }
        }

        $form->fields()->whereIn('id', array_diff($form->fields()->pluck('id')->toArray(), $fields))->delete();

        $order = 1;
        foreach ($request->get('fields') as $field) {
            if (isset($field['id'])) {
                $form->fields()->findOrFail($field['id'])->update([
                    'order' => $order,
                    'name' => $order,
                    'type' => $field['type'],
                    'required' => $field['required'],
                    $request->get('langform') => [
                        'title' => $field['title']
                    ]
                ]);
            } else {
                $form->fields()->create([
                    'order' => $order,
                    'name' => $order,
                    'type' => $field['type'],
                    'required' => $field['required'],
                    $request->get('langform') => [
                        'title' => $field['title']
                    ]
                ]);
            }

            $order++;
        }

        $form->update($request->all());

        flash('El formulario se ha actualizado correctamente.');

        return redirect()->to(route('admin::panel::forms::edit', ['id' => $id]) . '?langform=' . $request->get('langform'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $form = $this->form->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $form);
        $form->restore();
        flash('El formulario se ha recuperado correctamente.');

        return redirect()->route('admin::panel::forms::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $form = $this->form
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $form);
        $form->delete();

        flash('El formulario se ha eliminado correctamente.');

        return redirect()->route('admin::panel::forms::index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_translation(Request $request, $id)
    {
        $form = $this->form
            ->findOrFail($id);

        $this->authorize('delete', $form);
        $form->deleteTranslations($request->get('langform'));

        flash('La traducción del formulario se ha eliminado correctamente.');

        return redirect()->route('admin::panel::forms::edit', ['id' => $id]);
    }
}

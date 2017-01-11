<?php

namespace App\Http\Controllers\Web\Forms;

use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseWebController;

class FormsController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(Request $request, $id)
    {
        $form = $this->web->forms()
            ->with(['fields' => function ($query) {
                $query->orderBy('order');
            }])
            ->findOrFail($id);

        return view('forms.show', compact('form'));
    }

    public function send(Request $request, $id)
    {
        $this->validate($request, [
            'captcha' => 'required|captcha'
        ]);

        $form = $this->web->forms()
            ->where('id', '=', $id)
            ->firstOrFail();

        $data = $request->except(['_token', 'captcha']);

        foreach ($data as $field => $value) {
            if (! isset($form->fields()->where('name', '=', $field)->first()->title)) {
                abort(500);
            }
            $data[$form->fields()->where('name', '=', $field)->first()->title] = $value;
            unset($data[$field]);
        }

        Mail::send('emails.web.form', [
            'data' => $data,
            'form' => $form
        ], function ($m) use ($form) {
            $m->to($form->email)
                ->from($form->email)
                ->subject($form->subject);
        });

        flash('Mensaje enviado correctamente.');

        return redirect()->route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]);
    }
}

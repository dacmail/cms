<?php

namespace App\Http\Controllers\Admin\Panel\Animals;

use PDF;
use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Http\Controllers\Admin\BaseAdminController;

class ExportController extends BaseAdminController
{
    protected $animal;

    public function __construct(Animal $animal)
    {
        parent::__construct();

        $this->animal = $animal;
    }

    public function pdf($id)
    {
        $animal = $this->animal
            ->with(['web', 'translations', 'photos' => function ($query) {
                $query->main();
            }])
            ->findOrFail($id);

        $pdf = PDF::loadView('exports.animals.pdf', compact('animal'));

        return $pdf->stream();
    }

    public function word($id)
    {
    }
}

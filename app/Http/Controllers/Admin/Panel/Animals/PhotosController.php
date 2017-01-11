<?php

namespace App\Http\Controllers\Admin\Panel\Animals;

use App\Helpers\UploadFile;
use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Helpers\Traits\FilterBy;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\BaseAdminController;

class PhotosController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Animal
     */
    protected $animal;

    /**
     * PhotosController constructor.
     * @param Animal $animal
     */
    public function __construct(Animal $animal)
    {
        parent::__construct();

        $this->animal = $animal;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $animal = $this->web->animals()->with(['translations', 'media' => function ($query) {
            $query->where('type', 'photo');
        }])->findOrFail($id);

        return view('admin.panel.animals.photos.photos', compact('animal'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id)
    {
        $animal = $this->web->animals()->findOrFail($id);

        if ($request->hasFile('photos')) {
            $photos = [];

            checkFolder($this->web->getStorageFolder('images/animals'), 0775);

            foreach ($request->file('photos') as $file) {
                $path = 'web/' . $animal->web_id . '/animals/' . $animal->id . '/photos';
                $name = uniqid() . time();

                $photo = (new UploadFile($file, $path, $name))
                    ->resize(1000)
                    ->makeThumbnail(200, 200, 'thumbnail-xs-')
                    ->makeThumbnail(600, 600, 'thumbnail-m-')
                    ->getName();

                ! count($animal->photos) ? $main = 1 : $main = 0;

                $new_photo = $animal->media()->create([
                    'file' => $photo,
                    'type' => 'photo',
                    'main' => $main
                ]);

                array_push($photos, [
                    'url' => $new_photo->thumbnail_url,
                    'main_url' => route('admin::panel::animals::photos::main', ['animal_id' => $animal->id, 'id' => $new_photo->id]),
                    'delete_url' => route('admin::panel::animals::photos::delete', ['animal_id' => $animal->id, 'id' => $new_photo->id])
                ]);
            }

            return response()->json([
                'web_id' => $animal->web_id,
                'photos' => $photos
            ]);
        }

        return response()->json([
            'error' => true
        ], 500);
    }

    /**
     * @param $animal_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function main($animal_id, $id)
    {
        $this->web->animals()
            ->findOrFail($animal_id)
            ->photos()
            ->update([
                'main' => 0
            ]);

        $this->web->animals()
            ->findOrFail($animal_id)
            ->photos()
            ->findOrFail($id)
            ->update([
                'main' => 1
            ]);

        flash('Foto actualizada correctamente');

        return redirect()->route('admin::panel::animals::photos::index', ['animal_id' => $animal_id]);
    }

    /**
     * @param $animal_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($animal_id, $id)
    {
        $photo = $this->web->animals()
            ->findOrFail($animal_id)
            ->photos()
            ->findOrFail($id);

        $main = $photo->isMain();

        $files_to_delete = [
            $photo->getPath() . '/' . $photo->file,
            $photo->getPath() . '/' . $photo->getThumbnail('m'),
            $photo->getPath() . '/' . $photo->getThumbnail('xs'),
        ];

        foreach ($files_to_delete as $file) {
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
        }

        $photo->delete();

        if ($main && $photo = $this->web->animals()->findOrFail($animal_id)->photos()->first()) {
            $photo->update([
                'main' => 1
            ]);
        }

        flash('Foto eliminada correctamente');

        return redirect()->route('admin::panel::animals::photos::index', ['animal_id' => $animal_id]);
    }
}

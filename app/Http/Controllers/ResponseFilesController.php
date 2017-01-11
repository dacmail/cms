<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ResponseFilesController extends Controller
{
    public function animal_photo($id, $photo)
    {
        $path = storage_path('app/web/' . $this->web->id . '/animals/' . $id . '/photos/' . $photo);

        if (! is_file($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function web_file_upload($file)
    {
        $path = storage_path('app/web/' . $this->web->id . '/uploads/' . $file);

        if (! is_file($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function web_image($file)
    {
        $path = storage_path('app/web/' . $this->web->id . '/images/' . $file);

        if (! is_file($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}

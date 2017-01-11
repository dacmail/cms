<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Http\UploadedFile;

class UploadFile
{
    protected $file;

    protected $path;

    protected $name;

    protected $extension;

    protected $disk = null;

    protected $visibility = 'public';

    public function __construct(UploadedFile $file, $path, $name, $disk = null)
    {
        $this->file = $file;
        $this->path = $path ?: 'web/' . app('App\Models\Webs\Web')->id;
        $this->name = $name . '.' . $this->extension();
    }

    public function store()
    {
        $this->file->storeAs($this->path, $this->name, $this->disk);

        return $this;
    }

    public function resize($width = null, $height = null, $method = 'resize')
    {
        $photo = Image::make($this->file->getRealPath());

        $photo->$method($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        Storage::put($this->path . '/' . $this->name, $photo->stream()->__toString(), $this->visibility);

        return $this;
    }

    public function makeThumbnail($width = null, $height = null, $prepend = 'thumbnail-', $method = 'fit')
    {
        $thumbnail = Image::make($this->file->getRealPath());

        $thumbnail->$method($width, $height, function ($constraint) {
            $constraint->upsize();
        });
        
        Storage::put($this->path . '/' . $prepend . $this->name, $thumbnail->stream()->__toString(), $this->visibility);

        return $this;
    }

    public function extension()
    {
        return $this->file->extension() ?: 'jpg';
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFullPath()
    {
        return $this->path . '/' . $this->name;
    }

    public function getThumbnailName($size = 'xs')
    {
        return 'thumbnail-' . $size . '-' . $this->name;
    }
}

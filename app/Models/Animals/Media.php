<?php

namespace App\Models\Animals;

use App\Models\BaseModel;
use App\Helpers\Traits\LogsActivity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends BaseModel
{
    use SoftDeletes, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'animals_media';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'animal_id', 'type', 'file', 'thumbnail', 'url', 'main'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['animal'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeMain($query)
    {
        return $query->orderBy('main', 'DESC');
    }

    /**
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        if (! $this->file) {
            return null;
        }

        return route('animals::photo', ['id' => $this->animal_id, 'photo' => $this->file]);
    }

    /**
     * @return string
     */
    public function getPhotoPathAttribute()
    {
        if (! $this->file) {
            return null;
        }

        return Storage::disk()->getDriver()->getAdapter()->getPathPrefix() . $this->getPath() . '/' . $this->file;
    }

    /**
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
        $thumbnail = null;

        if (Storage::exists($this->getPath() . '/' . $this->getThumbnail())) {
            $thumbnail = $this->getThumbnail();
        } elseif (Storage::exists($this->getPath() . '/' . $this->getThumbnail('m'))) {
            $thumbnail = $this->getThumbnail('m');
        }

        $file = $thumbnail ?: $this->file;

        return route('animals::photo', ['id' => $this->animal_id, 'photo' => $file]);
    }

    /**
     * @return string
     */
    public function getThumbnailPathAttribute()
    {
        $thumbnail = null;

        if (Storage::exists($this->getPath() . '/' . $this->getThumbnail())) {
            $thumbnail = $this->getThumbnail();
        } elseif (Storage::exists($this->getPath() . '/' . $this->getThumbnail('m'))) {
            $thumbnail = $this->getThumbnail('m');
        }

        $file = $thumbnail ?: $this->file;

        return Storage::disk()->getDriver()->getAdapter()->getPathPrefix() . $this->getPath() . '/' . $file;
    }

    /**
     * @return string
     */
    public function getMediumThumbnailPathAttribute()
    {
        $thumbnail = null;

        if (Storage::exists($this->getPath() . '/' . $this->getThumbnail('m'))) {
            $thumbnail = $this->getThumbnail('m');
        }

        $file = $thumbnail ?: $this->file;

        return Storage::disk()->getDriver()->getAdapter()->getPathPrefix() . $this->getPath() . '/' . $file;
    }

    /**
     * @return string
     */
    public function getMediumThumbnailUrlAttribute()
    {
        $thumbnail = null;

        if (Storage::exists($this->getPath() . '/' . $this->getThumbnail('m'))) {
            $thumbnail = $this->getThumbnail('m');
        }

        $file = $thumbnail ?: $this->file;

        return route('animals::photo', ['id' => $this->animal_id, 'photo' => $file]);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return 'web/' . app('App\Models\Webs\Web')->id . '/animals/' . $this->animal_id . '/photos';
    }

    /**
     * @param string $size
     * @return string
     */
    public function getThumbnail($size = 'xs')
    {
        return 'thumbnail-' . $size . '-' . $this->file;
    }

    /**
     * @return mixed
     */
    public function isMain()
    {
        return $this->main;
    }

    /**
     * Relations
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}

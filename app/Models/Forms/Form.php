<?php

namespace App\Models\Forms;

use App\Models\BaseModel;
use App\Models\Webs\Web;
use App\Models\Users\User;
use App\Helpers\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends BaseModel
{
    use SoftDeletes, Translatable, LogsActivity;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'forms';

    /**
     * Translatable fields
     */
    public $translatedAttributes = [
        'title', 'slug', 'text', 'subject', 'user_id'
    ];

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'status'
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['web'];

    /**
     * Set animal translations
     *
     * @param Illuminate\Http\Request
     * @return $this
     */
    public function setTranslations($request)
    {
        foreach ($this->web->config['langs'] as $lang) {
            if (isset($request->get('translations')[$lang])) {
                if (empty($request->get('translations')[$lang]['title']) &&
                    empty($request->get('translations')[$lang]['slug']) &&
                    empty($request->get('translations')[$lang]['subject']) &&
                    empty($request->get('translations')[$lang]['text'])) {
                    if ($this->hasTranslation($lang)) {
                        $this->deleteTranslations($lang);
                    }

                    continue;
                }

                $translation = $this->translateOrNew($lang);
                $translation->title = $request->get('translations')[$lang]['title'] ?: null;
                $translation->slug = $request->get('translations')[$lang]['slug'] ?: null;
                $translation->subject = $request->get('translations')[$lang]['subject'] ?: null;
                $translation->text = $request->get('translations')[$lang]['text'] ?: null;
                $translation->save();
            }
        }

        return $this;
    }

    /**
     * Set attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($value === '') {
            $value = null;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Relations
     */
    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function translations()
    {
        return $this->hasMany(FormTranslation::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

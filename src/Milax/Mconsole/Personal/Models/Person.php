<?php

namespace Milax\Mconsole\Personal\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Person extends Model
{
    use \CascadeDelete, \HasUploads, \HasTags, \HasState;

    protected $fillable = ['slug', 'title', 'description', 'name', 'preview', 'biography', 'position', 'contacts', 'hired_at', 'enabled', 'weight'];

    protected $dates = [
        'hired_at',
    ];

    protected $casts = [
        'name' => 'array',
        'preview' => 'array',
        'biography' => 'array',
        'position' => 'array',
        'contacts' => 'array',
        'title' => 'array',
        'description' => 'array',
    ];

    /**
     * Automatically generate slug from name if empty, format for url
     *
     * @param void
     */
    public function setSlugAttribute($value)
    {
        if (strlen($value) == 0) {
            $name = Request::input('name');
            $this->attributes['slug'] = str_slug($name);
        } else {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Get person by slug
     *
     * @param  string $slug
     * @param  string $lang [Language key]
     * @return Milax\Mconsole\Personal|Models\Person
     */
    public function findBySlug($slug, $lang = null)
    {
        $person = $this->query()->where('slug', $slug)->firstOrFail();
        $localized = app('Milax\Mconsole\Contracts\ContentCompiler')->set($person)->localize($lang)->render()->get();

        return $localized;
    }

    /**
     * Get localized persons
     *
     * @param  Builder $query
     *
     * @return Collection
     */
    public function getCompiled($query = null)
    {
        if (is_null($query)) {
            $query = $this->query()->enabled();
        } else {
            $query = $query->enabled();
        }

        $persons = $query->get();

        foreach ($persons as $key => $person) {
            $persons[$key] = $this->findBySlug($person->slug, \App::getLocale());
        }

        return $persons;
    }
}

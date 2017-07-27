<?php

namespace Milax\Mconsole\Personal\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Personal\Contracts\Repositories\PersonRepository as Repository;
use Milax\Mconsole\Contracts\ContentCompiler;

class PersonRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Personal\Models\Person::class;

    public function __construct(ContentCompiler $compiler) {
        $this->compiler = $compiler;
    }

    public function findBySlug($slug, $lang = null)
    {
        $person = $this->query()->where('slug', $slug)->firstOrFail();
        $localized = $this->compiler->set($person)->localize($lang)->render()->get();

        return $localized;
    }

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

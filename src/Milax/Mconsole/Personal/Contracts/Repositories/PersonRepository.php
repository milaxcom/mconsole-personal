<?php

namespace Milax\Mconsole\Personal\Contracts\Repositories;

interface PersonRepository
{
    /**
     * Get person by slug
     *
     * @param  string $slug
     * @param  string $lang [Language key]
     * @return Milax\Mconsole\Personal|Models\Person
     */
    public function findBySlug($slug, $lang = null);

    /**
     * Get localized persons
     *
     * @param  Builder $query
     *
     * @return Collection
     */
    public function getCompiled($query = null);
}

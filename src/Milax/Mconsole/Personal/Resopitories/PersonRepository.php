<?php 

namespace Milax\Mconsole\Personal\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Personal\Models\Person as Repository;
use Milax\Mconsole\Contracts\ContentCompiler;

class PersonRepositroy extends EloquentRepository implements Repository
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
}
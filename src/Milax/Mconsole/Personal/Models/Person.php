<?php

namespace Milax\Mconsole\Personal\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Person extends Model
{
    use \CascadeDelete, \HasUploads, \HasTags, \HasState;
    
    protected $fillable = ['slug', 'title', 'description', 'name', 'preview', 'biograhy', 'position', 'contacts', 'hired_at', 'enabled'];
    
    protected $dates = [
        'hired_at',
    ];
    
    protected $casts = [
        'name' => 'array',
        'preview' => 'array',
        'biograhy' => 'array',
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
}

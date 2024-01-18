<?php

return [
    'module' => 'Manage personal',
    'quickmenu' => [
        'create' => 'Add person',
    ],
    'menu' => 'Personal',
    'table' => [
        'hired' => 'Hired',
        'updated' => 'Updated',
        'slug' => 'Address',
        'name' => 'Name',
        'position' => 'Position',
    ],
    'form' => [
        'published_at' => 'Published at',
        'name' => 'Name',
        'slug' => 'Slug',
        'content' => 'Content',
        'preview' => 'Preview text',
        'biography' => 'Biography',
        'contacts' => 'Contacts',
        'position' => 'Position',
        'seo' => 'SEO Settings',
        'title' => 'Title',
        'description' => 'Description',
        'gallery' => 'Gallery',
        'cover' => 'Cover',
        'slugify' => 'Generate',
        'enabled' => 'Published',
        'weight' => 'Weight',
    ],
    'settings' => [
        'group' => [
            'name' => 'Personal',
        ],
        'cover' => 'Use cover',
        'gallery' => 'Use gallery',
        'presets' => 'Enable to change presets',
    ],
    'acl' => [
        'index' => 'Personal: show list',
        'create' => 'Personal: show create form',
        'store' => 'Personal: saving',
        'edit' => 'Personal: show edit form',
        'update' => 'Personal: updating',
        'show' => 'Personal: view',
        'destroy' => 'Personal: delete',
    ],
    'info' => [
        'weight' => 'The higher the weight, the lower the record is displayed.',
    ],
];

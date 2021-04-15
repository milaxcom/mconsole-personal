<?php

use Milax\Mconsole\Personal\Installer;

/**
 * Personal module bootstrap file
 */
return [
    'name' => 'Personal',
    'identifier' => 'mconsole-personal',
    'description' => 'mconsole::personal.module',
    'depends' => [],
    'register' => [
        'middleware' => [],
        'providers' => [
            \Milax\Mconsole\Personal\Provider::class,
        ],
        'aliases' => [],
        'bindings' => [],
        'dependencies' => [],
    ],
    'tags' => [
        'personal',
    ],
    'install' => function () {
        Installer::install();
    },
    'uninstall' => function () {
        Installer::uninstall();
    },
    'init' => function () {
        app('API')->menu->push([
            'name' => 'mconsole::personal.menu',
            'url' => 'personal',
            'visible' => true,
            'enabled' => true,
        ], 'personal', 'content');
        
        app('API')->acl->register([
            ['GET', 'personal', 'mconsole::personal.acl.index'],
            ['GET', 'personal/create', 'mconsole::personal.acl.create'],
            ['POST', 'personal', 'mconsole::personal.acl.store'],
            ['GET', 'personal/{personal}/edit', 'mconsole::personal.acl.edit'],
            ['PUT', 'personal/{personal}', 'mconsole::personal.acl.update'],
            ['GET', 'personal/{personal}', 'mconsole::personal.acl.show'],
            ['DELETE', 'personal/{personal}', 'mconsole::personal.acl.destroy'],
        ], 'personal');
    },
];

<?php

namespace Milax\Mconsole\Personal;

use Milax\Mconsole\Contracts\Modules\ModuleInstaller;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'group' => 'mconsole::personal.options.settings.group',
            'label' => 'mconsole::personal.options.presets.name',
            'key' => 'personal_show_presets',
            'value' => '0',
            'type' => 'select',
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
            'enabled' => 1,
        ],
    ];
    
    public static $presets = [
        [
            'type' => \MconsoleUploadType::Image,
            'key' => 'personal',
            'name' => 'Personal',
            'path' => 'personal',
            'extensions' => ['jpg', 'jpeg', 'png'],
            'min_width' => 200,
            'min_height' => 200,
            'operations' => [
                [
                    'operation' => 'resize',
                    'type' => 'ratio',
                    'width' => '200',
                    'height' => '200',
                ],
                [
                    'operation' => 'save',
                    'path' => 'personal',
                    'quality' => '',
                ],
                [
                    'operation' => 'resize',
                    'type' => 'center',
                    'width' => '90',
                    'height' => '90',
                ],
                [
                    'operation' => 'save',
                    'path' => 'preview',
                    'quality' => '',
                ],
            ],
        ],
    ];
    
    public static function install()
    {
        app('API')->options->install(self::$options);
        app('API')->presets->install(self::$presets);
    }
    
    public static function uninstall()
    {
        app('API')->options->uninstall(self::$options);
        app('API')->presets->uninstall(self::$presets);
        
        $repository = new PersonalRepository(Person::class);
        foreach ($repository->get() as $instance) {
            $instance->delete();
        }
    }
}

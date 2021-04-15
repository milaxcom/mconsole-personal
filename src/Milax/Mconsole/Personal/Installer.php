<?php

namespace Milax\Mconsole\Personal;

use Milax\Mconsole\Contracts\Modules\ModuleInstaller;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'group' => 'mconsole::personal.settings.group.name',
            'label' => 'mconsole::personal.settings.presets',
            'key' => 'personal_show_presets',
            'value' => 0,
            'type' => 'select',
            'rules' => null,
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
        ],
        [
            'group' => 'mconsole::personal.settings.group.name',
            'label' => 'mconsole::personal.settings.cover',
            'key' => 'personal_has_cover',
            'value' => 1,
            'type' => 'select',
            'rules' => null,
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
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
        
        $repository = app('Milax\Mconsole\Personal\Models\Person');
        foreach ($repository->get() as $instance) {
            $instance->delete();
        }
    }
}

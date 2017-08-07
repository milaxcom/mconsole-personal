<?php

return [
    'module' => 'Персонал',
    'quickmenu' => [
        'create' => 'Добавить сотрудника',
    ],
    'menu' => 'Персонал',
    'table' => [
        'hired' => 'Нанят',
        'updated' => 'Обновлено',
        'slug' => 'Адрес',
        'name' => 'Имя',
        'position' => 'Должность',
    ],
    'form' => [
        'published_at' => 'Опубликовано',
        'name' => 'Имя',
        'slug' => 'Адрес',
        'content' => 'Контент',
        'preview' => 'Превью',
        'biography' => 'Биография',
        'contacts' => 'Контакты',
        'position' => 'Должность',
        'seo' => 'Настройки SEO',
        'title' => 'Заголовок',
        'description' => 'Описание',
        'gallery' => 'Галерея',
        'cover' => 'Обложка',
        'slugify' => 'Генерировать',
        'enabled' => 'Опубликовано',
        'weight' => 'Вес',
    ],
    'settings' => [
        'group' => [
            'name' => 'Персонал',
        ],
        'cover' => 'Поддержка обложки',
        'presets' => 'Выбор шаблона загрузки',
    ],
    'acl' => [
        'index' => 'Персонал: просмотр списка',
        'create' => 'Персонал: форма создания',
        'store' => 'Персонал: сохранение',
        'edit' => 'Персонал: форма редактирования',
        'update' => 'Персонал: обновление',
        'show' => 'Персонал: просмотр',
        'destroy' => 'Персонал: удаление',
    ],
    'info' => [
        'weight' => 'Чем больше вес, тем ниже отображается запись.',
    ],
];

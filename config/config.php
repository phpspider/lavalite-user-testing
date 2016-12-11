<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'test',

    /*
     * Package.
     */
    'package'   => 'test',

    /*
     * Modules.
     */
    'modules'   => ['test'],

    /*
     * Image size.
     */
    'image'    => [
        'xs' => [
            'width'     => '60',
            'height'    => '45',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'sm' => [
            'width'     => '160',
            'height'    => '120',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'md' => [
            'width'     => '460',
            'height'    => '345',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'lg' => [
            'width'     => '800',
            'height'    => '600',
            'action'    => 'resize',
            'watermark' => 'img/logo/default.png',
        ],
        'xl' => [
            'width'     => '1000',
            'height'    => '750',
            'action'    => 'resize',
            'watermark' => 'img/logo/default.png',
        ],
    ],

    'test'       => [
        'model'             => 'Test\Test\Models\Test',
        'table'             => 'tests',
        'presenter'         => \Test\Test\Repositories\Presenter\TestItemPresenter::class,
        'hidden'            => [],
        'visible'           => [],
        'guarded'           => ['*'],
        'slugs'             => ['slug' => 'name'],
        'dates'             => ['deleted_at'],
        'appends'           => [],
        'fillable'          => ['user_id', 'upload_folder', 'name'],
        'translate'         => ['name'],

        'upload-folder'     => '/uploads/test/test',
        'uploads'           => [
                                    'single'    => [],
                                    'multiple'  => [],
                               ],
        'casts'             => [
                               ],
        'revision'          => [],
        'perPage'           => '20',
        'search'        => [
            'name'  => 'like',
            'status',
        ],
    ],
];

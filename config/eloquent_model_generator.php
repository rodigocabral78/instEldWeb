<?php

return [
    'model_defaults' => [
        'namespace'       => 'App\\Models',
        'base_class_name' => \Illuminate\Database\Eloquent\Model::class,
        'output_path'     => 'Models',
        // 'no_timestamps'   => true,
        'no_timestamps'   => true,
        // 'date_format'     => 'Y-m-d H:i:s',
        'date_format'     => 'U',
        'connection'      => null,
        'backup'          => true,
    ],
];

<?php

return [
    //Start file monitor
    'enable' => env('APP_DEBUG', false),

    //Monitor Path
    'path' => [
        app()->path(),
        app()->getConfigurationPath(),
        app()->basePath().DIRECTORY_SEPARATOR.'routes'
    ],

    //Monitor interval, unit is seconds.
    'interval' => 2,
];
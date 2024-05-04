<?php

return [
    'driver' => [
        'android' => [
            'version' => env('DRIVER_ANDROID_VERSION', "1.0.0"),
            'is_forced' => env('DRIVER_ANDROID_FORCED', 1),
            'notes' => env('DRIVER_ANDROID_NOTES', ''),
        ],
        'ios' => [
            'version' => env('DRIVER_IOS_VERSION', "1.0.0"),
            'is_forced' => env('DRIVER_IOS_FORCED', 1),
            'notes' => env('DRIVER_IOS_NOTES', ''),
        ],
    ],

    'user' => [
        'android' => [
            'version' => env('USER_ANDROID_VERSION', "1.0.0"),
            'is_forced' => env('USER_ANDROID_FORCED', 1),
            'notes' => env('USER_ANDROID_NOTES', ''),
        ],
        'ios' => [
            'version' => env('USER_IOS_VERSION', "1.0.0"),
            'is_forced' => env('USER_IOS_FORCED', 1),
            'notes' => env('USER_IOS_NOTES', ''),
        ],
    ],
];

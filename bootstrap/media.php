<?php

use Blainesch\LaravelPrettyController\Http\MediaType;

MediaType::add('html', [
    'conditions' => [
        'accept' => [
            'text/html',
            '*/*',
        ],
    ],
    'encode' => function($request, $response) {
        $class = strtolower(str_replace('Controller', '', $request['controller']));
        return \View::make("{$class}.{$request['method']}")->with($response);
    },
]);

MediaType::add('json', [
    'conditions' => [
        'type' => 'json',
        'accept' => [
            'application/json',
            'application/x-json',
        ],
    ],
    'encode' => function($request, $response) {
        return json_encode($response);
    },
]);
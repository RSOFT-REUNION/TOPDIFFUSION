<?php

return [
    'merchant_id' => env('PAY_MERCHANT_ID'),
    'environment' => env('PAY_ENVIRONMENT', 'HOMO'),
    'access_key' => env('PAY_ACCESS_KEY'),
    'proxy_host' => env('PAY_PROXY_HOST'),
    'proxy_port' => env('PAY_PROXY_PORT'),
    'proxy_login' => env('PAY_PROXY_LOGIN'),
    'proxy_password' => env('PAY_PROXY_PASSWORD'),
];

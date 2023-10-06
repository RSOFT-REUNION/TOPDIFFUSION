<?php

return [
    'admin' => 'https://test-adminpayment.citelis.fr/v5/auth/login?redirectTo=%2Fback-office%2Ftransaction-details%2F40717926045631%2FPV4200923902952501',
    'merchant_id' => '40717926045631',
    'environment' => env('PAY_ENVIRONMENT', 'HOMO'),
    'access_key' => '6i5YR7mMOjZ8Jgej4yTJ',
    'proxy_host' => env('PAY_PROXY_HOST'),
    'proxy_port' => env('PAY_PROXY_PORT'),
    'proxy_login' => env('PAY_PROXY_LOGIN'),
    'proxy_password' => env('PAY_PROXY_PASSWORD'),
];

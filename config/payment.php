<?php

return [
    'admin' => env('PAY_HTTP_ADMIN', 'https://test-adminpayment.citelis.fr/v5/back-office/home'),
    'merchant_id' => env('PAY_MERCHANT_ID'),
    'environment' => env('PAY_ENVIRONMENT', 'HOMO'), // Par défaut l'environnement de test
    'access_key' => env('PAY_ACCESS_KEY_REF'),
    'proxy_host' => env('PAY_PROXY_HOST'),
    'proxy_port' => env('PAY_PROXY_PORT'),
    'proxy_login' => env('PAY_PROXY_LOGIN'),
    'proxy_password' => env('PAY_PROXY_PASSWORD'),
    'cancel_url' => env('PAY_CANCEL_URL'),
    'notification_url' => env('PAY_NOTIFICATION_URL'),
    'return_url' => env('PAY_RETURN_URL'),
    'contract_number' => env('PAY_CONTRACT_NUMBER')
];

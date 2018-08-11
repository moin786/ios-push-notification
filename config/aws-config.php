<?php
/*
 * AWS config file
 * 
 */
return [
    'SNS_ACCESS_KEY'  => 'YOUR-SNS-ACCESS-KEY',
    'SNS_SECRET_KEY'  => 'YOUR-SNS-SECRET-KEY',
    'SNS_APP_ARN'  => 'YOUR-SNS-APP-APN',
    'pushIos' => peal\iosnotification\IosPush::class,
];
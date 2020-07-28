<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/27/20
 * Time: 1:19 PM
 */

// Configure defaults for the whole application

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Africa/Nairobi');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

$settings['app_name'] = 'Custom Email Signature Generator - REST API';

$settings['error'] = [
    // Should be set to false in production
    'displayErrorDetails' => true,

    // Parameter is passed to the default error handler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'logErrorDetails' => true,

    // Display error details in log
    'logErrors' => false,
];

$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => '3306',
    'database' => 'emailsignaturegen_test',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ]
];

$settings['jwt'] = [
    // Issuer name
    'issuer' => 'www.cmshosting.xyz',

    // Max lifetime in seconds
    'lifetime' => 14400,

    // The public key
    'public_key' => '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAoyKL5ETz3XdGfMwG2VJ1
k7+nrOXw9ncVWmsya2B4Rb307jFKNq6GhWavbA1ZWsoIcvpUbXAYuPnTBgHAsiI3
mLwuuMKB9taugq1Dpx95a+XUTZk5gne0AtJqMa6TH5zeRoaLNo5ytjXn7H50ri8r
wpuK1UHvePiKsBEMWX7/6EE8bMhYRCFh/Uw0odSnVKGWFLDpHyoAs2PtQJ4CmWqe
NR8sGJEXHO3rqP5143j5Y/VURYIYDbI0LcrJsdclB17PExjilWiK2iIP+RwW5/MV
u6o5gHLvvUDC7qmMEx4PveEp9V504/JPef07JG6zsXiWxqMGwRrJeomE94jUnv7g
HQIDAQAB
-----END PUBLIC KEY-----',
];

return $settings;
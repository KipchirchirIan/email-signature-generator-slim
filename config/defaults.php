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

$settings['phinx'] = [
    'paths' => [
        'migrations' => $settings['root'] . '/resources/migrations',
        'seeds' => $settings['root'] . '/resources/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'email_signature_generator',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [],
        'testing' => []
    ],
    'version_order' => 'creation'
];

$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => '3306',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
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
        PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8mb4 COLLATE utf8mb4_general_ci'
    ]
];

$settings['jwt'] = [
    // Issuer name
    'issuer' => 'www.cmshosting.xyz',

    // Max lifetime in seconds
    'lifetime' => 14400,
];

return $settings;
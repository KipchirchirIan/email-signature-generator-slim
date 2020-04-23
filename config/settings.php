<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:47 PM
 */

use DI\Container;

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Africa/Nairobi');


return function (Container $container) {
    $container->set('settings', function () {
        return [
            'name' => 'Custom Email Signature Generator - REST API',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => false,
        ];
    });
};
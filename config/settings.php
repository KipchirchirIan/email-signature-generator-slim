<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:47 PM
 */

// Load default settings
$settings = require __DIR__ . '/defaults.php';

// Load environment configuration
if (file_exists(__DIR__ . '/../env.php')) {
    require __DIR__ . '/../env.php';
} elseif (file_exists(__DIR__ . '/env.php')) {
    require __DIR__ . '/env.php';
}

return $settings;
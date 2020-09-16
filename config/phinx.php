<?php

use Slim\App;

/** @var App $app */
$app = require __DIR__ . '/../config/bootstrap.php';

$container = $app->getContainer();
$pdo = $container->get(PDO::class);
$config = $container->get('settings');
$database = $config['db']['database'];
$phinx = $config['phinx'];

$phinx['environments']['development'] = [
    // Set database name
    'name' => $database,
    'connection' => $pdo
];

$phinx['environments']['testing'] = [
    // Set database name
    'name' => $database,
    'connection' => $pdo
];

return $phinx;
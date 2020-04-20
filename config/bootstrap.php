<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:46 PM
 */

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Create a container using PHP-DI
$container = new Container();

// Set a container to create App with AppFactory
AppFactory::setContainer($container);



return AppFactory::create();
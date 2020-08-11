<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:46 PM
 */

use App\Middleware\UrlGeneratorMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    $app->add(UrlGeneratorMiddleware::class);
    /**
     * The routing middleware should be added earlier than the ErrorMiddleware
     * Otherwise exceptions thrown from it will not be handled by the middleware
     */
    $app->addRoutingMiddleware();

    // Catch errors and exceptions
    $app->add(ErrorMiddleware::class);
};
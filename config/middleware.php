<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:46 PM
 */

use App\Middleware\CorsMiddleware;
use App\Middleware\HttpsMiddleware;
use App\Middleware\UrlGeneratorMiddleware;
use App\Middleware\JwtClaimMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    $app->add(UrlGeneratorMiddleware::class);
    $app->add(CorsMiddleware::class);
    // Authentication middleware
    $app->add(JwtClaimMiddleware::class);

    // Redirect HTTP traffic to HTTPS
//    $app->add(HttpsMiddleware::class);
    /**
     * The routing middleware should be added earlier than the ErrorMiddleware
     * Otherwise exceptions thrown from it will not be handled by the middleware
     */
    $app->addRoutingMiddleware();
    $app->add(BasePathMiddleware::class);

    // Catch errors and exceptions
    $app->add(ErrorMiddleware::class);
};
<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:46 PM
 */
use Slim\App;

return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();
    /**
     * The routing middleware should be added earlier than the ErrorMiddleware
     * Otherwise exceptions thrown from it will not be handled by the middleware
     */
    $app->addRoutingMiddleware();

    /**
     * @param bool $displayErrorDetails -> Should be set to false in production
     * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
     * @param bool $logErrorDetails -> Display error details in error log
     * which can be replaced by a callable of your choice.
     *
     * Note: This middleware should be added last. It will not handle any exceptions/errors
     * for middleware added after it.
     */
    $app->addErrorMiddleware(true, false, false);
};
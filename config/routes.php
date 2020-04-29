<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:47 PM
 */

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

return function(App $app) {
    $app->get('/', \App\Action\Home\HomeAction::class);

    $app->post('/users', \App\Action\User\UserCreateAction::class);
};
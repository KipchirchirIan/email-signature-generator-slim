<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:47 PM
 */

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app) {

    $app->group('/v1', function (RouteCollectorProxy $group) {

        $group->get('', \App\Action\Home\HomeAction::class);

        $group->get('/', \App\Action\Home\HomeAction::class);

        $group->post('/users', \App\Action\User\UserCreateAction::class);

        $group->get('/users', \App\Action\User\UserListDataTableAction::class);

        $group->put('/users/{id}', \App\Action\User\UserUpdateAction::class);
    });

};
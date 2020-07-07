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

        $group->get('/users/{id}', \App\Action\User\UserViewAction::class);

        $group->put('/users/{id}', \App\Action\User\UserUpdateAction::class);

        $group->delete('/users/{id}', \App\Action\User\UserDeleteAction::class);

        $group->post('/templates', \App\Action\Template\TemplateCreateAction::class);

        $group->get('/templates/{id}', \App\Action\Template\TemplateViewAction::class);

        $group->get('/templates', \App\Action\Template\TemplateListAction::class);

        $group->delete('/templates/{id}', \App\Action\Template\TemplateDeleteAction::class);

        $group->put('/templates/{id}', \App\Action\Template\TemplateUpdateAction::class);

        $group->post('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateCreateAction::class);

        $group->get('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateViewAction::class);

        $group->delete('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateDeleteAction::class);
    });

};
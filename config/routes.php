<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/20/20
 * Time: 2:47 PM
 */

use App\Middleware\JwtAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app) {

    $app->get('/', \App\Action\Home\HomeAction::class);

    $app->post('/v1/tokens', \App\Action\Auth\TokenCreateAction::class);

    $app->group('/v1', function (RouteCollectorProxy $group) {

        $group->get('', \App\Action\Home\HomeAction::class);

        $group->get('/', \App\Action\Home\HomeAction::class);

        $group->options('/users', \App\Action\PreFlightAction::class);

        $group->post('/users', \App\Action\User\UserCreateAction::class);

        $group->options('/users/{id}', \App\Action\PreFlightAction::class);

        $group->get('/users/{id}', \App\Action\User\UserViewAction::class);

        $group->put('/users/{id}', \App\Action\User\UserUpdateAction::class);

        $group->options('/templates', \App\Action\PreFlightAction::class);

        $group->options('/templates/{id}', \App\Action\PreFlightAction::class);

        $group->get('/templates/{id}', \App\Action\Template\TemplateViewAction::class);

        $group->get('/templates', \App\Action\Template\TemplateListAction::class);

        $group->options('/users/{id}/templates', \App\Action\PreFlightAction::class);

        $group->post('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateCreateAction::class);

        $group->get('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateViewAction::class);

        $group->delete('/users/{id}/templates', \App\Action\UserTemplate\UserTemplateDeleteAction::class);

        $group->options('/users/{id}/images', \App\Action\PreFlightAction::class);

        $group->post('/users/{id}/images', \App\Action\UserImage\UserImageCreateAction::class);

        $group->get('/users/{id}/images', \App\Action\UserImage\UserImageViewAction::class);

        $group->put('/users/{id}/images', \App\Action\UserImage\UserImageUpdateAction::class);

        $group->options('/socials', \App\Action\PreFlightAction::class);

        $group->get('/socials', \App\Action\Social\SocialListAction::class);

        $group->options('/socials/{id}', \App\Action\PreFlightAction::class);

        $group->get('/socials/{id}', \App\Action\Social\SocialViewAction::class);

        $group->options('/users/{id}/socials', \App\Action\PreFlightAction::class);

        $group->post('/users/{id}/socials', \App\Action\UserSocial\UserSocialCreateAction::class);

        $group->get('/users/{id}/socials', \App\Action\UserSocial\UserSocialListAction::class);

        $group->put('/users/{id}/socials', \App\Action\UserSocial\UserSocialUpdateAction::class);
    });

    $app->group('/v1', function (RouteCollectorProxy $group) {

        $group->delete('/users/{id}', \App\Action\User\UserDeleteAction::class);

        $group->get('/users', \App\Action\User\UserListDataTableAction::class);

        $group->post('/templates', \App\Action\Template\TemplateCreateAction::class);

        $group->delete('/templates/{id}', \App\Action\Template\TemplateDeleteAction::class);

        $group->put('/templates/{id}', \App\Action\Template\TemplateUpdateAction::class);

        $group->post('/socials', \App\Action\Social\SocialCreateAction::class);

        $group->put('/socials/{id}', \App\Action\Social\SocialUpdateAction::class);

        $group->delete('/socials/{id}', \App\Action\Social\SocialDeleteAction::class);

    })->add(JwtAuthMiddleware::class);

};
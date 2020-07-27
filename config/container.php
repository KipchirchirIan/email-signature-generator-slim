<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 4:05 PM
 */

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Selective\Validation\Encoder\JsonEncoder;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Selective\Validation\Transformer\ErrorDetailsResultTransformer;
use Slim\App;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Middleware\ErrorMiddleware;

return [
    // Application settings
//    Configuration::class => function () {
//        return new Configuration(require __DIR__ . '/settings.php');
//    },

    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    // For the responder
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get(Configuration::class)->getArray('error_handler_middleware');

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['displayErrorDetails'],
            (bool)$settings['logErrors'],
            (bool)$settings['logErrorDetails']
        );
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->getArray('db');

        $host = $settings['host'];
        $port = $settings['port'];
        $dbname = $settings['database'];
        $username = $settings['username'];
        $password = $settings['password'];
        $charset = $settings['charset'];
        $flags = $settings['flags'];
        $dsn = "mysql:host=$host:$port;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },

    ValidationExceptionMiddleware::class => function (ContainerInterface $container) {
        $factory = $container->get(ResponseFactoryInterface::class);

        return new ValidationExceptionMiddleware(
            $factory,
            new ErrorDetailsResultTransformer(),
            new JsonEncoder()
        );
    }

];
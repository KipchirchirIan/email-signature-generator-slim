<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 4:05 PM
 */

use App\Auth\JwtAuth;
use App\Handler\DefaultErrorHandler;
use Psr\Container\ContainerInterface;
use Selective\Validation\Encoder\JsonEncoder;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Selective\Validation\Transformer\ErrorDetailsResultTransformer;
use Slim\App;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Middleware\ErrorMiddleware;

return [
    // Application settings
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

    JwtAuth::class => function (ContainerInterface $container) {
        $config = $container->get('settings')['jwt'];

        $issuer = (string)$config['issuer'];
        $lifetime = (int)$config['lifetime'];
        $privateKey = (string)$config['private_key'];
        $publicKey = (string)$config['public_key'];

        return new JwtAuth($issuer, $lifetime, $privateKey, $publicKey);
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $config = $container->get('settings')['error'];

        $errorMiddleWare = new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$config['displayErrorDetails'],
            (bool)$config['logErrors'],
            (bool)$config['logErrorDetails']
        );

        $errorMiddleWare->setDefaultErrorHandler($container->get(DefaultErrorHandler::class));

        return $errorMiddleWare;
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['db'];

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
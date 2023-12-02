<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';


$appOptions = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($appOptions);
$container = $app->getContainer();


$app->get('/', function (Request $request, Response $response) {


    $response->getBody()->write('OLAAAA');
    return $response;

});

$app->run();
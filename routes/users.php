<?php

use function src\slimConfiguration;
use App\Controllers\UsersControllers;

$app = new \Slim\App(slimConfiguration());

$app->get('/', UsersControllers::class . ':getUsers');

$app->run();